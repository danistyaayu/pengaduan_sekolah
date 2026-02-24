<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriStatus extends Model
{
    use HasFactory;
    protected $table = 'histori_status';
    
    protected $fillable = [
        'aspirasi_id',
        'old_status',
        'new_status',
        'user_id',
        'note',
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