<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;


class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function scopeBetweenDates(Builder $query, $from, $to)
    {
        return $query->where('to', '>=', $to)
        ->where('from', '<=', $from);
    }
    public static function findByReviewKey(string $reviewKey) : ?Booking
    {
        # code...
        return static::where('review_key',$reviewKey)->with('bookable')->get()->first();
    }
    protected static function boot()
    {
        # code...
        parent::boot();

        static::creating(function ($booking){
                 $booking->review_key=Str::uuid();
        });
    }
}
