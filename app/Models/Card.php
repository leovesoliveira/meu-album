<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'sub_type',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
