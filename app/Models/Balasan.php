<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    use HasFactory;
     protected $table = 'balasan';
    protected $fillable = [
        'aspirasi_id',
        'user_id',
        'message',
        'is_private',
    ];

    // Relationship
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}