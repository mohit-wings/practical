<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventControllerRequest;
use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;
use Facade\Ignition\DumpRecorder\Dump;
use PDO;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();
        return view('event.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventControllerRequest $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
        $event->recurrence_time = $request->recurrence_time;
        $event->recurrence_day = $request->recurrence_day;
        $event->recurrence_duration = $request->recurrence_duration;
        $event->save();

        return redirect(route('event.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        // $start_date = Carbon::now();
        // $end_date = Carbon::createFromFormat('Y-m-d',$event->end_date);

        // $date_period_array = CarbonPeriod::create($start_date, $end_date)->toArray();

        $date_array = [];

        // foreach ($date_period_array as $key => $value) {

        //     $weekOfMonth = $this->weekOfMonth(strtotime($value->format('Y-m-d')));

        //     if(($value->dayOfWeek == $event->recurrence_day) && $weekOfMonth == $event->recurrence_time){
        //         $temp_date_array = [];
        //         $temp_date_array['date'] = $value->format('Y-m-d');
        //         $temp_date_array['day'] = $value->format('l');
        //         $date_array []= $temp_date_array;
        //     }

        // }

        $interval_sting = strtolower($event->week)." ".strtolower($event->day);

        $duration = ($event->recurrence_duration > 1) ? $event->recurrence_duration + 1 : 1;


        // dd("$interval_sting of +".$duration." month");

        $start_date = new DateTime($event->start_date);
        $end_date = new DateTime($event->end_date);
        $interval = DateInterval::createFromDateString("$interval_sting of +".$duration." month");

        $period = new DatePeriod($start_date,$interval,$end_date);

        foreach ($period as $key => $value) {
            if($key == 0){
                $startOfTheMonth = new Carbon($value->format('d-m-Y'));
                $dayOfTheMonth = Carbon::parse($interval_sting.' of '.$startOfTheMonth->startOfMonth()->format('M Y'));

                if($dayOfTheMonth->gte($start_date)){
                    $date_array[] = $dayOfTheMonth->format('Y-m-d');
                }

                continue;
            }

            $date_array[]= $value->format('Y-m-d');
        }

        return view('event.show',compact('event','date_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventControllerRequest $request, $id)
    {
        $event = Event::find($id);
        $event->title = $request->title;
        $event->start_date = Carbon::parse($request->start_date);
        $event->end_date = Carbon::parse($request->end_date);
        $event->recurrence_time = $request->recurrence_time;
        $event->recurrence_day = $request->recurrence_day;
        $event->recurrence_duration = $request->recurrence_duration;
        $event->save();

        return redirect(route('event.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect(route('event.index'));
    }

    public function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return $this->weekOfYear($date) - $this->weekOfYear($firstOfMonth) + 1;
    }

    public function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }
}
