<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingData extends Model
{
    use HasFactory;
    protected $table = 'setting_datas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tempMin','tempMax','phMin','phMax', 'feedMax'
    ];
}
