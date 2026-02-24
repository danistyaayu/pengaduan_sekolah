<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;
    protected $table = 'aspirasi';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'location',
        'status',
        'priority',
        'aspirasi_code',
    ];

    protected $casts = [
        'status' => 'string',
        'priority' => 'string',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balasan()
    {
        return $this->hasMany(Balasan::class);
    }

    public function historiStatus()
    {
        return $this->hasMany(HistoriStatus::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Helper methods
    public function getStatusBadge()
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">⏳ Pending</span>',
            'in_progress' => '<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">🔄 In Progress</span>',
            'resolved' => '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">✅ Resolved</span>',
            'rejected' => '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">❌ Rejected</span>',
        ];
        return $badges[$this->status] ?? '';
    }

    public function getPriorityBadge()
    {
        $badges = [
            'low' => '<span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">Low</span>',
            'medium' => '<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Medium</span>',
            'high' => '<span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">High</span>',
            'urgent' => '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Urgent</span>',
        ];
        return $badges[$this->priority] ?? '';
    }
}