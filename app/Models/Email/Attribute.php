<?php

namespace App\Models\Email;

trait Attribute {

    public function getStatusAttribute()
    {
        return $this->statusType->name ?? '';
    }
}
