<?php

namespace CHRobinson\Core;

use Cache;
use CHRobinson\Http\HttpClient;
use CHRobinson\Http\HttpRequest;
use CHRobinson\Http\Injector;

class AuthorizationInjector implements Injector
{
    private $client;

    private $environment;

    private $refreshToken;

    public $accessToken;

    public function __construct(HttpClient $client, CHRobinsonEnvironment $environment, $refreshToken)
    {
        $this->client = $client;
        $this->environment = $environment;
        $this->refreshToken = $refreshToken;
    }

    public function inject($request)
    {
        if (! $this->hasAuthHeader($request) && ! $this->isAuthRequest($request)) {
            if (is_null($this->accessToken) || $this->accessToken->isExpired()) {
                $this->accessToken = $this->fetchAccessToken();
            }
            $request->headers['Authorization'] = 'Bearer '.$this->accessToken->token;
        }
    }

    private function fetchAccessToken()
    {
        $key = $this->environment instanceof SandboxEnvironment ? 'sandbox-access-token' : 'production-access-token';

        $cached_token = Cache::get($key, false);

        if ($cached_token) {
            $accessToken = new AccessToken(
                $cached_token->access_token,
                $cached_token->token_type,
                $cached_token->expires_in,
                $cached_token->create_time
            );

            if (! $accessToken->isExpired()) {
                return $accessToken;
            }
        }

        $accessTokenResponse = $this->client->execute(new AccessTokenRequest($this->environment, $this->refreshToken));
        $accessToken = $accessTokenResponse->result;

        $jsonData = [
            'access_token' => $accessToken->access_token,
            'token_type' => $accessToken->token_type,
            'expires_in' => $accessToken->expires_in,
            'create_time' => time(),
        ];

        Cache::put($key, (object) $jsonData);

        return new AccessToken($accessToken->access_token, $accessToken->token_type, $accessToken->expires_in);
    }

    private function isAuthRequest($request)
    {
        return $request instanceof AccessTokenRequest;
    }

    private function hasAuthHeader(HttpRequest $request)
    {
        return array_key_exists("Authorization", $request->headers);
    }
}
