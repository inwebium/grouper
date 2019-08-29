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

namespace Inwebium\Grouper\Data;

/**
 * Description of CsvDataSource
 *
 * @author inwebium
 */
class CsvDataSource extends AbstractDataSource
{
    private $delemiter;
    private $enclosure;
    private $hasHeader;
    
    public function __construct(&$source, $delemiter = ',', $enclosure = '"', $hasHeader = false)
    {
        $this->source = fopen($source, 'r');
        $this->delemiter = $delemiter;
        $this->enclosure = $enclosure;
        $this->hasHeader = $hasHeader;
    }

    public function getDataGenerator()
    {
        $header = [];
        
        if ($this->hasHeader) {
            $header = fgetcsv(
                $this->source, 
                0, 
                $this->delemiter, 
                $this->enclosure
            );
        }
        
        while (feof($this->source) === false) {
            $item = fgetcsv($this->source, 0, $this->delemiter, $this->enclosure);

            if (!empty($header)) {
                $item = array_combine($header, $item);
            }

            yield $item;
        }
    }
    
    public function __destruct()
    {
        fclose($this->source);
    }
}
