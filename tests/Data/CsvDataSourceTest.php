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
 * Description of CsvDataSourceTest
 *
 * @author inwebium
 */
class CsvDataSourceTest extends \PHPUnit\Framework\TestCase
{
    private function csvExpectedSimpleItemsProvider()
    {
        return [
            [
                'Jessica',
                20,
                'Blue',
            ],
            [
                'Amber',
                27,
                'Red',
            ],
            [
                'Audrey',
                31,
                'Black',
            ],
            [
                'Deborah',
                27,
                'Pink',
            ],
            [
                'Daisy',
                21,
                'Yellow',
            ],
        ];
    }
    
    private function csvExpectedItemsProvider()
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
    
    public function testGetDataGenerator()
    {
        $filename = __DIR__ . '/../example.csv';
        $dataSource = new \Inwebium\Grouper\Data\CsvDataSource(
            $filename, 
            ';', 
            '"'
        );
        
        $expectedItems = $this->csvExpectedSimpleItemsProvider();
        $counter = 0;
        
        foreach ($dataSource->getDataGenerator() as $dataItem) {
            $this->assertEquals($expectedItems[$counter], $dataItem);
            $counter++;
        }
        
        $filename = __DIR__ . '/../example-w-head.csv';
        $dataSource = new \Inwebium\Grouper\Data\CsvDataSource(
            $filename, 
            ';', 
            '"',
            true
        );
        
        $expectedItems = $this->csvExpectedItemsProvider();
        $counter = 0;
        
        foreach ($dataSource->getDataGenerator() as $dataItem) {
            $this->assertEquals($expectedItems[$counter], $dataItem);
            $counter++;
        }
    }
}
