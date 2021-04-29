<?php

namespace App\Models\Email;

use App\Models\ApiLog\EmailLog;
use App\Models\EmailStatusType\EmailStatusType;
use App\Models\File\File;

trait Relation {

    public function attachments()
    {
        return $this->belongsToMany(
            File::class,
            'email_attachments',
            'email_id',
            'file_id'
        );
    }

    public function logs()
    {
        return $this->hasMany(EmailLog::class, 'email_id', 'id');
    }

    public function statusType()
    {
        return $this->belongsTo(EmailStatusType::class, 'email_status_type_id', 'id');
    }
}
