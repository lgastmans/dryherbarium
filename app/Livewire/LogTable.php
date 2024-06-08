<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LogTable extends Component
{

    public $period = '_WEEK';

    public function load()
    {
        //dd($this->days);
        $this->render();
    }

    public function render()
    {
        $users = Auth::user()->get();

        $from = Carbon::now();
        $to = Carbon::now()->subDays(6);

        if ($this->period == '_WEEK') {
            $from = Carbon::now()->subDays(6)->format('Y-m-d');
            $to = Carbon::now()->format('Y-m-d');
        }
        elseif ($this->period == '_MONTH') {
            $to = Carbon::now()->format('Y-m-d');
            $from = Carbon::now()->firstOfMonth()->format('Y-m-d');
            //dd($from, $to);
        }
        elseif ($this->period == '_6MONTHS') {
            $to = Carbon::now()->format('Y-m-d');
            $from = Carbon::now()->subMonths(5)->format('Y-m-d');
        }

        if ($this->period == '_ALL') {
            $activities = Activity::orderBy('created_at','desc')->get();
        }
        else {
            $activities = Activity::whereBetween('created_at', [$from, $to])->orderBy('created_at','desc')->get();
        }

        $res = [];
        foreach ($activities as $key=>$activity)
        {
            $res[$key]['created_at'] = \Carbon\Carbon::parse($activity->created_at)->format('d M Y');

            $res[$key]['username'] = $activity->causer->name;

            $res[$key]['description'] = $activity->description;

            foreach ($activity->properties as $key2=>$value)
            {
                //dd(">".$key2."::".$value);
                $res[$key]['description'] .= "<br>(".$key2.": ".$value.")";
            }

        }

        return view('livewire.log-table', ['activities'=>$res, 'period'=>$this->period, 'users'=>$users]);
    }
}
