<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    protected $fillable = [
        'valor',
        'gasto',
        'fecha',
        'user_id'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
