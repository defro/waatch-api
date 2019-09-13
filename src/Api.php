<?php

namespace Defro\Waatch;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Api
{
    private const BASE_URL = 'https://api.waatch.co/v1';

    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var string $apiKey Your own api key
     */
    private $apiKey;

    /**
     * @var string $language ISO-639-1 language code
     */
    private $language = 'en';

    /**
     * @var string $country ISO-3166 country code
     */
    private $country;


    /**
     * Api constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $apiKey
     * @return Api
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $language
     * @return Api
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param string $country
     * @return Api
     */
    public function setCountry(string $country): self
    {
        $allowedCountries = [
            'fr', //France
            'us', //United States
            'gb', //United Kingdom
            'ca', //Canada
        ];

        if (!in_array($country, $allowedCountries, true)) {
            throw new Exception(sprintf(
                'The country "%s" is not allowed; allowed countries are %s.',
                $country, implode(', ', $allowedCountries)
            ));
        }

        $this->country = $country;

        return $this;
    }

    /**
     * @param string $scope
     * @param array $additonnalQueryParams
     * @return mixed
     * @throws Exception
     */
    private function callApi(string $scope, array $additonnalQueryParams = [])
    {
        $queryParameters = array_merge([
            'api_key' => $this->apiKey,
            'language' => $this->language,
        ], $additonnalQueryParams);

        if (null !== $this->country) {
            $queryParameters['country'] = strtoupper($this->country);
        }

        $uri = self::BASE_URL . $scope . '?' . http_build_query($queryParameters);

        try {
            $response = $this->client->request('GET', $uri);
        } catch (GuzzleException $e) {
            throw new Exception(sprintf(
                'Exception thrown by client: %s',
                $e->getMessage()
            ), $e);
        }

        if (200 !== $response->getStatusCode()) {
            throw new Exception(sprintf(
                'Bad status code %d returned when called uri %s', $response->getStatusCode(), $uri
            ));
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get detail info about the movie
     *
     * @param string $id Check first TMDb ID or IMDB ID (Example: tt2543164), then CNC ID, and finally Allocine, SensCritique or Netflix ID (based on id_service parameter).
     * @param string|null $serviceId Optional parameter to specify if search is based on Allocine, SensCritique ou Netflix ID. (values are "allocine", "senscritique" or "netflix")
     * @return mixed
     */
    public function getMovie(string $id, string $serviceId = null)
    {
        $params = $serviceId ? ['id_service' => $serviceId] : [];

        return $this->callApi('/movies/' . $id, $params);
    }

    /**
     * Get all Movies and TV Shows for a specific provider
     *
     * @param string $id Provider Code. Example: netfx.
     * @param int $page Specify which page to query, default value is 1.
     * @return mixed
     */
    public function getProvider(string $id, int $page = 1)
    {
        return $this->callApi(
            '/offers/' . $id, ['page' => $page]
        );
    }

    /**
     * Get all providers
     *
     * @return mixed
     */
    public function getProviders()
    {
        return $this->callApi(
            '/providers'
        );
    }

    /**
     * Get detail info about the tv-show
     *
     * @param string $id TMDb ID or IMDB ID. Example: tt2543164.
     * @return mixed
     */
    public function getTvShow(string $id)
    {
        return $this->callApi('/shows/' . $id);
    }

}
