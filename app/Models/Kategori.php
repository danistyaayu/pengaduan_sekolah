<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

     protected $table = 'kategori';
    protected $fillable = [
        'name',
        'description',
        'color_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Helper method
    public function getIcon()
    {
        $icons = [
            'Fasilitas Sekolah' => '🏫',
            'Bullying' => '👥',
            'Kurikulum' => '📚',
            'Kebersihan' => '🧹',
            'Listrik' => '🔌',
            'Keamanan' => '🔒',
            'Lainnya' => '📝',
        ];
        return $icons[$this->name] ?? '📝';
    }
}