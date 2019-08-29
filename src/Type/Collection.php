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

namespace Inwebium\Grouper\Type;

/**
 * Description of Collection
 *
 * @author inwebium
 */
class Collection implements \ArrayAccess, \Countable, \Iterator
{
    private $type;
    /**
     * @var $type[]
     */
    private $items;
    
    public function __construct($type)
    {
        $this->type = $type;
        $this->items = [];
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * 
     * @return $type[]
     */
    public function getItems()
    {
        return $this->items;
    }

    public function getItemsGenerator()
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }
    
    public function add(object $item)
    {
        if ($item instanceof $this->type) {
            $this->items[] = $item;
        } else {
            throw new \Exception(
                'Trying to add an item of incopatible type '
                . 'to collection of type ' . $this->type
                );
        }
        
        return $this;
    }
    
    public function set($key, object $item)
    {
        if ($item instanceof $this->type) {
            $this->items[$key] = $item;
        } else {
            throw new \Exception(
                'Trying to set an item of incopatible type '
                . 'in collection of type ' . $this->type
                );
        }
        
        return $this;
    }
    
    public function count(): int
    {
        return count($this->items);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    public function valid(): bool
    {
        return key($this->items) !== null;
    }

}