<?php
/**
 * phpEthereum\Helper
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Wilson<Wilson@wasoon.cn>
 * @link      https://github.com/wasoon/php-ethereum
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace phpEthereum;


/**
 * Class Helper
 * @package phpEthereum
 */
class Helper
{
    /**
     * @var array
     */
    protected $_params = [];

    /**
     * @var string|int|null
     */
    protected $_id = null;

    /**
     * @param string $method
     * @return array
     */
    public function send($method)
    {
        $params = $this->getParams();
        $id = $this->getId();

        // delete namespace
        if(false !== strpos($method, '\\')) {
            $method = substr(strrchr($method, '\\'), 1);
        }

        $method = lcfirst($method);

        $requestDatas = [
            'method' => $method,
            'jsonrpc' => '2.0',
            'params' => $params
        ];

        if(!is_null($id)) {
            $requestDatas['id'] = $id;
        }

        return $requestDatas;
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
}