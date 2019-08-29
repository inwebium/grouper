<?php
/**
 * This file is part of the inwebium/grouper library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Mikhail Korneev <inwebium@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://github.com/inwebium/grouper GitHub
 */

namespace Inwebium\Grouper\Test;

/**
 * Description of SubstringHandlerTest
 *
 * @author inwebium
 */
class SubstringHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyFunction()
    {
        $handler = new \Inwebium\Grouper\Handler\SubstringHandler();
        
        $handler->setParams([
            'field' => 'Name',
            'value' => 'e',
            'start' => 1,
            'length' => 1
        ]);
        
        $item = [
            'Name'  => 'Jessica',
            'Age'   => 20,
            'Color' => 'Blue'
        ];
        
        $this->assertEquals(
            'Name', 
            $handler->applyFunction($item)
        );
        
        
        $item = [
            'Name'  => 'Jassice',
            'Age'   => 20,
            'Color' => 'Blue'
        ];
        
        $this->assertEquals(
            'other', 
            $handler->applyFunction($item)
        );
        
        $item = [
            'ID'    => 3,
            'Month' => 'March'
        ];

        $this->assertEquals(
            'other', 
            $handler->applyFunction($item)
        );
    }
}
