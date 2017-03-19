<?php


namespace App\Tasks\Reservation;

use App\Studio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreateReservationTask
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Studio
     */
    private $studio;

    /**
     * @var array
     */
    private $params;

    /**
     * CreateReservationTask constructor.
     * @param Request $request
     * @param Studio $studio
     */
    public function __construct(Request $request, Studio $studio)
    {

        $this->request = $request;
        $this->studio  = $studio;
    }

    public function handle()
    {
        // get the params and
        // create a new reservation for the studio
        $this->studio->reservations()->create($this->params());

    }

    public function params()
    {
        $date = Carbon::parse($this->request->date);

        // calculate hours and minutes of day
        $time    = explode(':', $this->request->from);
        $hours   = $time[0];
        $minutes = $time[1];

        $bookingFrom = Carbon::parse($this->request->date)->addHours($hours)->addMinutes($minutes);
        $bookingTill = Carbon::parse($this->request->date)->addHours($hours)->addMinutes($minutes)->addHours(intval($this->request->hours));
        
        return [
            'from'    => $bookingFrom,
            'to'      => $bookingTill,
            'user_id' => 1
        ];
    }


}