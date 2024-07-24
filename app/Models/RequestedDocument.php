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
    ];

    protected $table = 'requesteddocuments';

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'userprofile_id');
    }
}
