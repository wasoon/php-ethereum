<?php
/**
 * php-ethereum
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

class WaSoonLoader
{
    private static function _autoload ($class_name)
    {
        if (0 === stripos($class_name, __NAMESPACE__ ))
        {
            $class_path = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
            $fileName = substr($class_path, strlen(__NAMESPACE__) + 1);
            if (0 === stripos($class_name, __NAMESPACE__ . '\\'))
            {
                $class_file = (__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $fileName . '.php');
            }

            /*
            if(empty($class_file) || !is_file($class_file)) {
                $class_file = (__DIR__ . DIRECTORY_SEPARATOR . $class_path . '.php');
            }*/
            
            #var_dump($class_name . '-------' . $class_file);
            
            if(isset($class_file) && is_file($class_file))
            {
                return (require $class_file);
            }            
        }
        
        return false;
    }
    
    public static function setup()
    {
        spl_autoload_register(array(__CLASS__, '_autoload'));
    }
}

WaSoonLoader::setup();
