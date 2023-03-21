<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InAttachment extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'path',
        'application_id'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    
}
