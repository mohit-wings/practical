<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['week','day','duration'];

    public function getWeekAttribute(){
        if($this->recurrence_time == 1){
            return 'First';
        }else if($this->recurrence_time == 2){
            return 'Second';
        }else if($this->recurrence_time == 3){
            return 'Third';
        }else if($this->recurrence_time == 4){
            return 'Fourth';
        }
    }

    public function getDayAttribute(){
        if($this->recurrence_day == 0){
            return 'Sunday';
        }else if($this->recurrence_day == 1){
            return 'Monday';
        }else if($this->recurrence_day == 2){
            return 'Tuesday';
        }else if($this->recurrence_day == 3){
            return 'Wednesday';
        }else if($this->recurrence_day == 4){
            return 'Thursday';
        }else if($this->recurrence_day == 5){
            return 'Friday';
        }else if($this->recurrence_day == 6){
            return 'Saturday';
        }
    }

    public function getDurationAttribute(){
        if($this->recurrence_duration == 1){
            return 'Month';
        }else if($this->recurrence_duration == 3){
            return '3 Months';
        }else if($this->recurrence_duration == 4){
            return '4 Months';
        }else if($this->recurrence_duration == 6){
            return '6 Months';
        }else if($this->recurrence_duration == 12){
            return 'Year';
        }
    }
}
