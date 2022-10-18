<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
    ];

    protected $appends = [
        'total_cards',
        'total_quantity_cards',
        'total_at_least_one_cards',
        'total_quantity_repeated_cards',
        'percent_complete'
    ];

    protected function totalCards(): Attribute
    {
        return new Attribute(
            get: fn () => $this->cards->count(),
        );
    }

    protected function totalQuantityCards(): Attribute
    {
        return new Attribute(
            get: fn () => $this->cards->sum('quantity'),
        );
    }

    protected function totalAtLeastOneCards(): Attribute
    {
        $atLeastOneCards = $this->cards->filter(fn ($card) => $card->quantity >= 1);

        return new Attribute(
            get: fn () => $atLeastOneCards->count(),
        );
    }

    protected function totalQuantityRepeatedCards(): Attribute
    {
        $repeatedCards = $this->cards->filter(fn ($card) => $card->quantity >= 2);

        return new Attribute(
            get: fn () => $repeatedCards->sum('quantity'),
        );
    }

    protected function percentComplete(): Attribute
    {
        $atLeastOneCards = $this->cards->filter(fn ($card) => $card->quantity >= 1);

        return new Attribute(
            get: fn () => (int) ($atLeastOneCards->count() / $this->cards->count() * 100),
        );
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
