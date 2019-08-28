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
 * Description of Grouper
 *
 * @author inwebium
 */
class Grouper
{
    /**
     * @var \Inwebium\Grouper\Handler\AbstractHandler
     */
    private $handler;
    /**
     * @var \Inwebium\Grouper\Data
     */
    private $data;
    /**
     * @var \Inwebium\Grouper\Result
     */
    private $result;
    
    public function __construct(Data $data, Handler\AbstractHandler $handler)
    {
        $this->handler = $handler;
        $this->data = $data;
        $this->result = new Result();
        $this->result->addGroups($this->handler->getResultGroups());
    }

    private function setHandler(Handler\AbstractHandler $handler)
    {
        $this->handler = $handler;
        return $this;
    }

    private function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    private function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getResult()
    {
        return $this->result;
    }
    
    public function processData()
    {
        foreach ($this->data->getDataGenerator() as $item) {
            $this->result->addItem(
                $this->handler->applyFunction(
                    $item
                ), 
                $item
            );
        }
        
        return $this;
    }
}
