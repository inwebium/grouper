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
 *
 * @author inwebium
 */
interface HandlerInterface
{
    public function __construct();
    public function getParams() : iterable;
    public function setParams(iterable $params);
    public function getResultGroups() : iterable;
    public function applyFunction(iterable &$item);
}
