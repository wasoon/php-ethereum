<?php
/**
 * phpEthereum
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
 * Class phpEthereum
 * @package phpEthereum
 */
class phpEthereum
{
    /**
     * @var string
     */
    protected $_url = '';

    /**
     * phpEthereum constructor.
     * @param string $url
     */
    public function __construct($url = 'http://localhost:8545/')
    {
        $this->setUrl($url);
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param $name
     * @param $arguments

    public function __call($name, $arguments)
    {
        $function = ucfirst($name);

        return self::createInstance($function);
    }*/

    /**
     * @param string $function
     * @return mixed
     */
    public static function createInstance($function)
    {
        $function = ucfirst($function);
        $class = __NAMESPACE__ . '\\' . $function . '\\' . $function;
        $instance = new $class();

        return $instance;
    }

    /**
     * @return mixed
     */
    public function eth()
    {
        return self::createInstance(ucfirst(__FUNCTION__));
    }

    public function db()
    {
        return self::createInstance(ucfirst(__FUNCTION__));
    }

    public function net()
    {
        return self::createInstance(ucfirst(__FUNCTION__));
    }

    public function shh()
    {
        return self::createInstance(ucfirst(__FUNCTION__));
    }

    public function web3()
    {
        return self::createInstance(ucfirst(__FUNCTION__));
    }
}
