<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    public function priceFor($from,$to):array
    {
        $days = (new Carbon($from))->diffinDays(new Carbon($to)) + 1;
        $price = $days * $this->price;
        return[
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ]
            ];




    }

}
