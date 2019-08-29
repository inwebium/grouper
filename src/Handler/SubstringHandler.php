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

namespace Inwebium\Grouper\Handler;

/**
 * Description of SubstringHandler
 *
 * @author inwebium
 */
class SubstringHandler extends AbstractHandler
{
    protected function setDefaultParams()
    {
        $this->params = [
            'field' => 'id',
            'value' => 'a',
            'start' => 0,
            'length' => 0
        ];
    }
    
    public function getResultGroups(): iterable
    {
        return [
            $this->params['field']
        ];
    }

    public function applyFunction(iterable &$item)
    {
        if (substr(
            $item[$this->params['field']], 
            $this->params['start'], 
            $this->params['length']) === $this->params['value']
        ) {
            return $this->params['field'];
        } else {
            return 'other';
        }
    }
}
