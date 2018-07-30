<?php
/**
 * phpEthereum\Personal
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Wilson<Wilson@wasoon.cn>
 * @link      https://github.com/wasoon/php-ethereum
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace phpEthereum\Personal;
use phpEthereum\Helper;

/**
 * Class Eth
 * @package phpEthereum\Personal
 */
class Personal extends Helper
{
    public function __call($name, $arguments)
    {
        return $this->send(__CLASS__ . '_' . $name);
    }
}