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
use phpEthereum\JsonRPC\Client;


/**
 * Class Helper
 * @package phpEthereum
 */
class Helper extends Client
{
    /**
     * @param string $method
     * @return array
     */
    public function send($method)
    {
        // delete namespace
        if(false !== strpos($method, '\\')) {
            $method = substr(strrchr($method, '\\'), 1);
        }

        $method = lcfirst($method);

        $this->setMethod($method);

        return $this->request();
    }
}