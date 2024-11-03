<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // protected $fillable = [
    //     'avgTemp', 'avgPh', 'avgFeed', 'status', 'date'
    // ];
    use HasFactory;

    // Pastikan untuk meng-cast kolom 'date' sebagai tanggal
    protected $casts = [
        'date' => 'datetime',
    ];

    // Alternatif jika menggunakan Laravel versi lama:
    // protected $dates = ['date'];

    public function statusBadge()
    {
        return $this->status === 'Safe' ? 'badge-success' :
                ($this->status === 'Warning' ? 'badge-warning' : 'badge-danger');
    }

    public function feedStatusBadge($feedMax)
    {
        return $this->avgFeed < $feedMax ? 'badge-success' : 'badge-danger';
    }

    public function feedStatusText($feedMax)
    {
        return $this->avgFeed < $feedMax ? 'Pakan Tersedia' : 'Pakan Hampir Habis';
    }
}
