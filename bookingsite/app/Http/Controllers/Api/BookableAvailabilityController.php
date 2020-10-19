<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id,Request $request)
    {
        //
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d|after_or_equal:now',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);
        //    dd($data);
    //    dd($data);
        $bookable = Bookable::findOrFail($id);
        // dd($bookable->bookings);
        //  dd($bookable->bookings()->betweenDates($data['from'], $data['to'])->count());

        return
        $bookable->availableFor($data['from'], $data['to'])
        ? response()->json([])
        : response()->json([],404);

}
}
