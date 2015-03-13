<?php

namespace Sajari\Engine;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Client as HttpClient;
use Psr\Log\LoggerInterface;
use Sajari\Common\Exception\ExceptionListener;
use Sajari\Common\Exception\InvalidArgumentException;
use Sajari\Engine\Exception\NamespaceExceptionFactory;
use Sajari\Engine\Exception\Parser\EngineExceptionParser;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

class EngineClient
{
    /**
     * @var string
     */
    const DEFAULT_SCHEME = 'https';

    /**
     * @var string
     */
    const DEFAULT_HOST = 'www.sajari.com';

    /**
     * @var string
     */
    const DEFAULT_PATH_PREFIX = 'api';

    /**
     * @var integer
     */
    const DEFAULT_PORT = 443;

    /**
     * @var integer The default recursion depth for the fingerprint method
     */
    const DEFAULT_FINGEPRINT_RECURSION_DEPTH = 2;

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var string
     */
    private $pathPrefix;

    /**
     * @var string
     */
    private $accessKey;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $collectionName;

    /**
     * @var array
     */
    private $options;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var integer
     */
    private $fingerprintRecursionDepth;

    /**
     * @var string
     */
    private $fingerprintMimeType = 'application/sajari+fingerprint';

    /**
     * @var array
     */
    private $lastErrors = array();

    /**
     * @var mixed
     */
    private $lastRequest;

    /**
     * @var mixed
     */
    private $lastResponse;

    /**
     * @var mixed
     */
    private $lastRawResponse;

    /**
     * Constructor.
     *
     * @param ClientInterface $httpClient
     * @param array           $options
     * @param LoggerInterface $logger
     */
    public function __construct(ClientInterface $httpClient, array $options, LoggerInterface $logger = null)
    {
        $this->httpClient = $httpClient;

        $scheme = isset($options['scheme']) ? $options['scheme'] : static::DEFAULT_SCHEME;
        $host = isset($options['host']) ? $options['host'] : static::DEFAULT_HOST;
        $port = isset($options['port']) ? $options['port'] : static::DEFAULT_PORT;
        $pathPrefix = isset($options['path_prefix']) ? $options['path_prefix'] : static::DEFAULT_PATH_PREFIX;

        $accessKey = isset($options['access_key']) ? $options['access_key'] : null;
        $secretKey = isset($options['secret_key']) ? $options['secret_key'] : null;

        $this->scheme = $scheme;
        $this->host = $host;
        $this->port = $port;
        $this->pathPrefix = $pathPrefix;

        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;

        $this->companyName = isset($options['company']) ? $options['company'] : null;
        $this->collectionName = isset($options['collection']) ? $options['collection'] : null;

        $this->options = $options;

        $this->logger = $logger;
        $this->fingerprintRecursionDepth = static::DEFAULT_FINGEPRINT_RECURSION_DEPTH;

        $exceptionFactory = new NamespaceExceptionFactory(
            new EngineExceptionParser(),
            'Sajari\\Engine\\Exception',
            'Sajari\\Engine\\Exception\\EngineException'
        );

        $this->httpClient->addSubscriber(new StatusCodeListener());
        $this->httpClient->addSubscriber(new ExceptionListener($exceptionFactory));

        $connectTimeout = 10;
        $timeout = 10;

        if (isset($this->options['curl.options']['CURLOPT_CONNECTTIMEOUT'])) {
            $connectTimeout = (integer) $this->options['curl.options']['CURLOPT_CONNECTTIMEOUT'];
        }
        if (isset($this->options['curl.options']['CURLOPT_TIMEOUT'])) {
            $timeout = (integer) $this->options['curl.options']['CURLOPT_TIMEOUT'];
        }

        $this->httpClient->setBaseUrl(sprintf('%s://%s', $this->scheme, $this->host));
        $this->httpClient->setConfig(array(
            HttpClient::SSL_CERT_AUTHORITY => false,
            HttpClient::CURL_OPTIONS => array(
                CURLOPT_CONNECTTIMEOUT => $connectTimeout,
                CURLOPT_TIMEOUT => $timeout,
            ),
        ));
    }

    /**
     * Get the document with the ID given in the "id" field.
     *
     * @param array $opts
     *
     * @return array|null The document or null if not found
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function get(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('get', $id), $opts);

        if ($response) {
            return $response;
        }

        return;
    }

    /**
     * Remove the document with the ID given in the "id" field.
     *
     * @param array $opts
     *
     * @return Boolean True if destroyed
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function remove(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('remove', $id), $opts);

        return $response && true;
    }

    /**
     * Add a document to the engine.
     *
     * If a file path is specified, the file will be sent along with the input
     * data. In this case, the MIME type should also be specified.
     *
     * @param array $opts
     *
     * @return string|Boolean The ID of the newly added document, otherwise false if the add failed
     */
    public function add(array $opts, $filePath = null )
    {
        $response = $this->doRequest(array('add'), $opts, $filePath);

        if ($response && isset($response['docId'])) {
            return $response['docId'];
        }

        return false;
    }

    /**
     * Replace the document with the given ID.
     *
     * @param array $opts
     *
     * @return string|Boolean The ID of the replaced document, otherwise false if the replace failed
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function replace(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('replace', $id), $opts);

        if ($response && isset($response['docId'])) {
            return $response['docId'];
        }

        return false;
    }

    public function search(array $opts)
    {
        if (isset($opts['meta'])) {
            $opts['meta'] = $this->encodeColumns($opts['meta']);
        }
        if (isset($opts['scales'])) {
            $opts['scales'] = $this->encodeScales($opts['scales']);
        }
        if (isset($opts['filters'])) {
            $opts['filters'] = $this->encodeFilters($opts['filters']);
        }

        $response = $this->doRequest(
            array('search'),
            $opts
        );

        $emptyResult = array(
            'results' => array(),
            'totalMatches' => 0,
            'time' => 0,
        );

        // Since results could be null we use array_key_exists
        if ($response && array_key_exists('results', $response)) {
            return null === $response['results'] ? $emptyResult : array(
                'results' => $response['results'],
                'totalMatches' => isset($response['totalmatches']) ? $response['totalmatches'] : 0,
                'time' => isset($response['msecs']) ? $response['msecs'] : 0,
            );
        }

        return $emptyResult;
    }

    public function fingerprint(array $opts)
    {
        return $this->doFingerprint($opts);
    }

    public function getLastErrors()
    {
        return $this->lastErrors;
    }

    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    public function getLastRawResponse()
    {
        return $this->lastRawResponse;
    }

    /**
     * @throws InvalidArgumentException When any of the options "company", "collection" are not provided
     */
    private function doRequest(array $uriParts, $data = array(), $filePath = null)
    {
        $this->lastErrors = array();

        if (!isset($data['company'])) {
            $data['company'] = $this->companyName;
        }
        if (!isset($data['collection'])) {
            $data['collection'] = $this->collectionName;
        }
        foreach (array('company', 'collection') as $key) {
            if (!isset($data[$key])) {
                throw new InvalidArgumentException(sprintf('The option "%s" must be provided.', $key));
            }
        }

        $uri = sprintf('%s/%s', $this->pathPrefix, implode('/', $uriParts));
         
        if (!count($data) && null === $filePath) {
            $request = $this->httpClient->get($uri);
        } else {
            $request = $this->httpClient->post($uri);

            if (count($data)) {
                $request->addPostFields($data);
            }

            if (null !== $filePath) {
                $mimeType = MimeTypeGuesser::getInstance()->guess($filePath);

                $request->addPostFile('inputfile', $filePath, $mimeType);
            }
        }

        $request->setPort($this->port);

        if ($this->accessKey && $this->secretKey) {
            $request->setAuth($this->accessKey, $this->secretKey);
        }

        if (null !== $this->logger) {
            $this->logger->debug(sprintf('Sending request to Sajari engine: %s', $request));
        }

        $response = $request->send();

        if (null !== $this->logger) {
            $this->logger->debug(sprintf('Received response from Sajari engine: %s', $response->getBody(true)));
        }

        $this->lastRawResponse = $response->getBody(true);

        $jsonResponse = $response->json();

        $this->lastResponse = $response;

        if (!$jsonResponse) {
            $this->lastErrors[] = 'No response';

            return false;
        }

        $statusCode = (integer) $jsonResponse['statusCode'];

        if ($statusCode === 200) {
            $result = true;

            if (isset($jsonResponse['response'])) {
                $result = $jsonResponse['response'];

                if (isset($jsonResponse['msecs'])) {
                    $result['msecs'] = $jsonResponse['msecs'];
                }
            }

            return $result;
        }

        $errors = isset($jsonResponse['errors']) ? $jsonResponse['errors'] : array('Unknown error');

        $this->lastErrors = array_merge($this->lastErrors, $errors);

        return false;
    }

    private function encodeColumns(array $columns)
    {
        return implode(',', $columns);
    }

    private function encodeScales(array $scales)
    {
        $output = array();

        foreach ($scales as $scale) {
            if (is_array($scale) &&
                isset($scale['meta']) &&
                isset($scale['center']) &&
                isset($scale['radius']) &&
                isset($scale['start']) &&
                isset($scale['end'])
            ) {
                $output[] = sprintf(
                    '%s,%d,%d,%.2f,%.2f',
                    $scale['meta'],
                    $scale['center'],
                    $scale['radius'],
                    $scale['start'],
                    $scale['end']
                );
            } else {
                throw new InvalidArgumentException(sprintf('Invalid scale: %s.', var_export($scale, true)));
            }
        }

        return implode('|', $output);
    }

    private function encodeFilters(array $filters)
    {
        $output = array();

        foreach ($filters as $filter) {
            foreach ($filter as $key => $value) {
                if (!is_array($value)) {
                    $value = array((string) $value);
                }

                $output[] = implode(',', array($key, implode(',', $value)));
            }
        }

        return implode('|', $output);
    }

    private function doFingerprint(array $opts, $depth = 0)
    {
        if ($depth >= $this->fingerprintRecursionDepth) {
            return false;
        }

        $response = $this->doRequest(array('fingerprint'), $opts);

        if (!$response) {
            if (null !== $this->logger) {
                $this->logger->error(sprintf(
                    'Failed to fingerprint query. The request was: %s. The raw response was: %s.',
                    var_export($this->lastRequest, true),
                    var_export($this->lastRawResponse, true)
                ));
            }

            return $this->doFingerprint($opts, $depth + 1);
        }

        if (isset($opts['decoded']) && true === $opts['decoded']) {
            return $response;
        }

        return $response['fingerprint'];
    }
}
