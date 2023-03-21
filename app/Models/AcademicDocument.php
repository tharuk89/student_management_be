<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicDocument extends Model
{
    use HasFactory;

    protected $table = 'academic_document';

    protected $fillable = [
        'document_name',
        'document_type',
        'document_url',
        'user_id'
    ];
}
