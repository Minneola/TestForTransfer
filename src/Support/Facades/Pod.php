<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Support\Facades;

use Minneola\TestFoo\Support\Facade;

/**
 * Class Pod
 * @package Minneola\TestFoo\Support\Facades
 */
class Pod extends Facade
{
    public static function getFacadeName()
    {
        return 'pod';
    }
} 
