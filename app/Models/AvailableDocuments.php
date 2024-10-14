<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'available_documents'
    ];

    protected $table = "available_documents";
}
