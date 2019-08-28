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

namespace Inwebium\Grouper\Result;

/**
 * Container for the item from Data which passed handler and made it to the 
 * Result. Result object contains collections of these objects.
 *
 * @author inwebium
 */
class ResultItem implements \ArrayAccess
{
    private $content;
    
    public function __construct($item)
    {
        $this->content = $item;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->content[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->content[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        throw new BadMethodCallException(
            get_class($this) . ' is readonly class. Tryed to set.'
        );
    }

    public function offsetUnset($offset): void
    {
        throw new BadMethodCallException(
            get_class($this) . ' is readonly class. Tryed to unset.'
        );
    }
    
    public function __get($name)
    {
        if (isset($this->content[$name])) {
            return $this->content[$name];
        } else {
            return null;
        }
    }
}
