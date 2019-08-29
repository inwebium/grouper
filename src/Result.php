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
 * Description of Result
 *
 * @author inwebium
 */
class Result
{
    /**
     * @var \Inwebium\Grouper\Type\Collection
     */
    private $content;
    
    public function __construct()
    {
        $this->content = new Type\Collection(Type\Collection::class);
        
        $this->content['other'] = new Type\Collection(Result\ResultItem::class);
    }
    
    private function setContent(Type\Collection $content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    public function getGroups()
    {
        $result = [];
        
        foreach ($this->content as $group => $collection) {
            $result[] = $group;
        }
        
        return $result;
    }
    
    public function addGroups($groups)
    {
        foreach ($groups as $group) {
            $this->addGroup($group);
        }
        
        return $this;
    }
    
    public function addGroup($group)
    {
        $this->content[$group] = new Type\Collection(Result\ResultItem::class);
        
        return $this;
    }
    
    public function addItem($group, $item)
    {
        $this->content[$group]->add(new Result\ResultItem($item));
        
        return $this;
    }
    
    public function getArray()
    {
        $result = [];
        
        foreach ($this->content as $group => $collection) {
            $result[$group] = $collection->getItems();
        }
        
        return $result;
    }
    
    public function getCounts()
    {
        $result = [];
        
        foreach ($this->content as $group => $collection) {
            $result[$group] = count($collection->getItems());
        }
        
        return $result;
    }

    public function clear()
    {
        $this->content = new Type\Collection(Type\Collection::class);
        
        $this->content['other'] = new Type\Collection(Result\ResultItem::class);
    }
}
