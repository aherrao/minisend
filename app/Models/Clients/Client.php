<?php

namespace App\Models\Clients;

use App\Models\BaseModel;

class Client extends BaseModel
{
    use ClientRepository;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        /** Alert: Dont' call parent boot */
    }
}
