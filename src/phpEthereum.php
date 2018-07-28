<?php
/**
 * phpEthereum
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    Wilson<Wilson@wasoon.cn>
 * @copyright Copyright (C) 2018, WaSoon Inc. All rights reserved.
 * @link      https://github.com/wasoon/php-ethereum
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace phpEthereum;

class phpEthereum
{
    protected $_host = '';

    public function __construct($host = 'http://localhost:8545/')
    {
        $this->setHost($host);
    }

    public function setHost($host = '')
    {
        $this->_host = $host;
    }

    public function connect($host = '')
    {
        if($host) {
            $this->setHost($host);
        }
    }
}
