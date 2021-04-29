<?php

namespace App\Models\Users;

use App\Models\Profiles\Profile;

trait UserRelationship {

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}