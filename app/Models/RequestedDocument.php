<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
       'userprofile_id',
       'requested_document',
       'copies_ctc',
       'copies_orig',
       'purpose',
       'status',
       'check_graduate',
       'last_term',
       'last_school_year',
       'check_correction',
       'orig_name',
       'reject_reason'
    ];

    protected $table = 'requesteddocuments';

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'userprofile_id');
    }
}
