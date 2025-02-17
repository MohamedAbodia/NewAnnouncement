<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DataDisplayOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type'
    ];
    protected $casts = ['type' => 'array'];

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
}
