<?php

namespace CHRobinson\Http;

class HttpClient
{
    public $environment;
    public $injectors = [];
    public $encoder;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
        $this->encoder = new Encoder;
    }

    /**
     * Injectors are blocks that can be used for executing arbitrary
     * pre-light logic, such as modifying a request or logging data.
     * Executed in first-in first-out order (Queue)
     */
    public function addInjector(InjectorInterface $inj)
    {
        $this->injectors[] = $inj;
    }

    /**
     * Takes an HTTP request, serializes the request, makes a call to a given environment,
     * and deserializes the response
     */
    public function execute(HttpRequest $httpRequest): HttpResponse
    {
        $requestCpy = clone $httpRequest;
        $curl = new Curl();

        foreach ($this->injectors as $inj) {
            $inj->inject($requestCpy);
        }

        $url = $this->environment->baseUrl() . $requestCpy->path;
        $formattedHeaders = $this->prepareHeaders($requestCpy->headers);
        if (!array_key_exists("user-agent", $formattedHeaders)) {
            $requestCpy->headers["user-agent"] = $this->userAgent();
        }

        $body = "";
        if (!is_null($requestCpy->body)) {
            $rawHeaders = $requestCpy->headers;
            $requestCpy->headers = $formattedHeaders;
            $body = $this->encoder->serializeRequest($requestCpy);
            $requestCpy->headers = $this->mapHeaders($rawHeaders,$requestCpy->headers);
        }

        $curl->setOpt(CURLOPT_URL, $url);
        $curl->setOpt(CURLOPT_CUSTOMREQUEST, $requestCpy->verb);
        $curl->setOpt(CURLOPT_HTTPHEADER, $this->serializeHeaders($requestCpy->headers));
        $curl->setOpt(CURLOPT_RETURNTRANSFER, 1);
        $curl->setOpt(CURLOPT_HEADER, 0);

        if (!is_null($requestCpy->body)) {
            $curl->setOpt(CURLOPT_POSTFIELDS, $body);
        }

        if (strpos($this->environment->baseUrl(), "https://") === 0) {
            $curl->setOpt(CURLOPT_SSL_VERIFYPEER, true);
            $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
        }

        if ($caCertPath = $this->getCACertFilePath()) {
            $curl->setOpt(CURLOPT_CAINFO, $caCertPath);
        }

        $response = $this->parseResponse($curl);
        $curl->close();

        return $response;
    }
}
