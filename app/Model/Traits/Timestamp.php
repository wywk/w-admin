<?php

namespace App\Model\Traits;

use DateTimeInterface;

/**
 * 解决时区问题
 * Trait Timestamp
 * @package App\Model\Traits
 */
trait Timestamp
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
