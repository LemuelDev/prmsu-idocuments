<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'extensionname',
        'name',
        'email',
        'age',
        'sex',
        'course',
        'address',
        'birthday',
        'year',
        'phone_number'
    ];

    protected $table = 'userprofiles';
    
    public function user()
    {
            return $this->hasOne(User::class, 'userprofile_id')->onDelete('cascade');
    }

    public function requestedDocuments()
    {
        return $this->hasMany(RequestedDocument::class, 'userprofile_id');
    }

}
