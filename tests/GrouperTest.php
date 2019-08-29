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
 * Description of GrouperTest
 *
 * @author inwebium
 */
class GrouperTest extends \PHPUnit\Framework\TestCase
{   
    private function getMockArray()
    {
        return [
            [
                'Name'  => 'Jessica',
                'Age'   => 20,
                'Color' => 'Blue',
            ],
            [
                'Name'  => 'Amber',
                'Age'   => 27,
                'Color' => 'Red',
            ],
            [
                'Name'  => 'Audrey',
                'Age'   => 31,
                'Color' => 'Black',
            ],
            [
                'Name'  => 'Deborah',
                'Age'   => 27,
                'Color' => 'Pink',
            ],
            [
                'Name'  => 'Daisy',
                'Age'   => 21,
                'Color' => 'Yellow',
            ],
        ];
    }
    
    private function getArrayData()
    {
        return new \Inwebium\Grouper\Data(
        $this->getMockArray(), 
            \Inwebium\Grouper\Data\ArrayDataSource::class
        );
    }
    
    private function getExpectedFromArrayData($type = null)
    {
        $result = new \Inwebium\Grouper\Result();
        
        $result->addGroups(['Age', 'other']);
        
        $result
            ->addItem('Age', $this->getMockArray()[1])
            ->addItem('Age', $this->getMockArray()[3])
            ->addItem('other', $this->getMockArray()[0])
            ->addItem('other', $this->getMockArray()[2])
            ->addItem('other', $this->getMockArray()[4]);
        
        if ($type == 'counts') {
            return $result->getCounts();
        } elseif ($type == 'array') {
            return $result->getArray();
        } elseif ($type == 'groups') {
            return $result->getGroups();
        } else {
            return $result;
        }
    }

    public function testProcessDataOnArray()
    {
        $data = $this->getArrayData();
        $handler = new \Inwebium\Grouper\Handler\ValueHandler();
        $handler
            ->setParams(['field' => 'Age', 'value' => 27]);
        $grouper = new \Inwebium\Grouper\Grouper($data, $handler);
        
        $grouper->processData();

        $this->assertEquals(
            $this->getExpectedFromArrayData(), 
            $grouper->getResult()
        );
        
        $this->assertEquals(
            $this->getExpectedFromArrayData('array'), 
            $grouper->getResult()->getArray()
        );
        
        $this->assertEquals(
            $this->getExpectedFromArrayData('counts'), 
            $grouper->getResult()->getCounts()
        );
        
        $this->assertEquals(
            $this->getExpectedFromArrayData('groups'), 
            $grouper->getResult()->getGroups()
        );
    }
}
