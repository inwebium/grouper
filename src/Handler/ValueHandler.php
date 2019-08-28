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
 * Description of ValueHandler
 *
 * @author inwebium
 */
class ValueHandler extends AbstractHandler
{
    public function getResultGroups(): iterable
    {
        return [
            $this->params['field']
        ];
    }
    
    protected function setDefaultParams()
    {
        $this->params = [
            'field' => 'id',
            'value' => null
        ];
    }

    public function applyFunction(iterable &$item)
    {
        if ($item[$this->params['field']] === $this->params['value']) {
            return $this->params['field'];
        } else {
            return 'other';
        }
    }

}
