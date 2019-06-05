<?php


namespace Mundipagg\Tmdb\WebService;


use Magento\Framework\HTTP\ZendClientFactory;
use \Magento\Framework\HTTP\ZendClient;
use Mundipagg\Tmdb\Helper\Data;
use Zend\Http\Headers;
use Zend\Stdlib\Parameters;
use \Zend\Http\Request;
use \Zend\Http\Client;

class TmdbWebServiceOld implements TmdbWebServiceInterfaceOld
{
    /**
     * @var \Zend\Http\Request $clientFactory
     */
    private $client;

    /**
     * @var \Zend\Http\Client $clientFactory
     */
    private $request;

    /**
     * @var \Magento\Framework\HTTP\ZendClientFactory $clientFactory
     */
    private $clientFactory;

    /**
     * @var \Mundipagg\Tmdb\Helper\Data
     */
    private $helperData;

    /**
     * Parameters to be sent
     *
     * @var array
     */
    private $customParameters;

    /**
     * TmdbWebService constructor.
     * @param ZendClientFactory $clientFactory
     */
    public function __construct(Request $request, Client $client, Data $helperData)
    {
        $this->request = $request;
        $this->client = $client;
        $this->helperData = $helperData;
        $this->customParameters = [
            "api_key" => $this->helperData->getGeneralConfig("api_key")
        ];
    }

    /**
     * Returns uri string
     *
     * @return stringt
     */
    public function getUri():string
    {
//        return $this->helperData->getGeneralConfig("base_uri_api")."search/movie";
        return "https://api.themoviedb.org/3/"."search/movie";
    }

    /**
     * Returns HTTP request to events url
     *
     * @return \Zend\Http\Request
     */
    public function getRequest(): Request
    {
        if (!isset($this->request)) {
            $this->request->setUri($this->getUri());
            $this->request->setMethod(ZendClient::GET);

            $headers = new Headers();
            $headers->addHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]);
            $this->request->setHeaders($headers);

            $this->client->setOptions(
                [
                    'adapter'   => 'Zend\Http\Client\Adapter\Curl',
                    'curloptions' => [CURLOPT_FOLLOWLOCATION => true],
                    'maxredirects' => 0,
                    'timeout' => 30
                ]
            );
            $this->request->setQuery(new Parameters($this->customParameters));

        }
        return $this->request;
    }

    /**
     * Add custom parameters to send with API request
     *
     * @param array $data
     * @return \Mundipagg\Tmdb\WebService\TmdbWebServiceInterface $this
     */
    public function addData(array $data): TmdbWebServiceInterface
    {
        $this->customParameters = array_merge($this->customParameters, $data);
        return $this;
    }

    /**
     * Instantiates request if necessary and sends off with collected data
     *
     * @return mixed
     */
    public function sendRequest()
    {
        $response = $this->client->send($this->request);

        return json_decode($response->getBody());
    }
}