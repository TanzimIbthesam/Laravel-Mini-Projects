<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{

    use HasFactory;
    protected $guarded=[];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function availableFor($from, $to): bool
    {
        // if($this->bookings()->betweenDates($from, $to)->count()){

        // }
        return  1===$this->bookings()->betweenDates($from, $to)->count();
    }

}
