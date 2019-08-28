<?php
/**
 * This file is part of the inwebium/stats library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Mikhail Korneev <inwebium@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://github.com/inwebium/stats GitHub
 */

namespace Inwebium\Grouper\Handler;

/**
 * Description of AbstractHandler
 *
 * @author inwebium
 */
abstract class AbstractHandler implements HandlerInterface
{
    protected $params;
    
    public function __construct()
    {
        $this->setDefaultParams();
    }
    
    public function getParams(): iterable
    {
        return $this->params;
    }
    
    public function setParams(iterable $params)
    {
        $this->params = $params;
        
        return $this;
    }
    
    abstract protected function setDefaultParams();
}
