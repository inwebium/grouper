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

namespace Inwebium\Grouper;

/**
 * Description of Data
 *
 * @author inwebium
 */
class Data
{
    /**
     * @var \Inwebium\Grouper\Data\AbstractDataSource
     */
    private $dataSource;
    
    public function __construct($data, $dataSource)
    {
        $this->dataSource = new $dataSource($data);
    }

    private function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
        return $this;
    }
    
    public function getDataSource()
    {
        return $this->dataSource;
    }

    public function getDataGenerator()
    {
        return $this->dataSource->getDataGenerator();
    }

    private function determineDataSorceType()
    {

        if (is_iterable($this->data)) {
            if (is_array($this->data)) {
                return \Inwebium\Grouper\Data\ArrayDataSource::class;
            }
        }

        if (is_resource($this->data)) {
            return \Inwebium\Grouper\Data\FileDataSource::class;
        }

    }
}
