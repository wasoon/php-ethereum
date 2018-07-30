<?php
/**
 *  JSON-RPC Client
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Wilson<Wilson@wasoon.cn>
 * @link      https://github.com/wasoon/php-ethereum
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace phpEthereum\JsonRPC;

/**
 * Class Client
 * @package phpEthereum\JsonRPC
 */
class Client
{
    /**
     * @var string
     */
    protected static $_url = '';

    /**
     * @var string
     */
    protected $_jsonrpc = '2.0';

    /**
     * @var string
     */
    protected $_method = '';

    /**
     * @var array
     */
    protected $_params = [];

    /**
     * @var string|int|null
     */
    protected $_id = null;

    /**
     * @var string
     */
    protected $_requestMethod = 'POST';

    protected $_header = [
        "Content-Type" => "application/json; charset=utf8"
    ];

    /**
     * @return bool|mixed|string
     */
    public function request()
    {
        $jsonrpc = $this->getJsonRPC();
        $params = $this->getParams();
        $method = $this->getMethod();
        $id = $this->getId();
        $url = self::getUrl();

        $requestDatas = [
            'jsonrpc' => $jsonrpc,
            'params' => $params,
            'method' => $method
        ];

        if( !is_null($id) ) {
            $requestDatas['id'] = $id;
        }

        $opts = array(
            'http' => array(
                'method' => $this->getRequestMethod(),
                'header' => $this->makeHeader($this->_header),
                'content' => json_encode($requestDatas),
                'timeout' => 20
            )
        );

        $context = stream_context_create($opts);
        $fp = @fopen($url, 'r', false, $context);
        $response = '';
        if($fp) {
            $response = stream_get_contents($fp);
            fclose($fp);
        } else {
            throw new \Exception("fopen error.");
        }

        $response = json_decode($response, true);

        return $response;
    }

    /**
     * @param $url
     */
    public static function setUrl($url)
    {
        self::$_url = $url;
    }

    /**
     * @return string
     */
    public static function getUrl()
    {
        return self::$_url;
    }

    /**
     * @param $jsonrpc
     * @return $this
     */
    public function setJsonRPC($jsonrpc)
    {
        $this->_jsonrpc = $jsonrpc;
        return $this;
    }

    /**
     * @return string
     */
    public function getJsonRPC()
    {
        return $this->_jsonrpc;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params = [])
    {
        $this->_params = $params;

        return $this;
    }

    /**
     * @return int|null|string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int|null|string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setRequestMethod($method)
    {
        $this->_requestMethod = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->_requestMethod;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header)
    {
        $this->_header = array_merge($this->_header, $header);
        return $this;
    }

    /**
     * @param array $headers
     * @return string
     */
    public function makeHeader(array $headers)
    {
        $header = '';
        foreach($headers as $key => $value)
        {
            $header .= "{$key}: {$value}\r\n";
        }

        return $header;
    }
}