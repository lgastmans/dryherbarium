<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Status;

class StatusController extends Controller
{

    /**
     * Display a listing of the resource. 
     */
    public function index(): View
    {
        return view('statuses', [
            //
        ]);
    }

    /**
     * Display a listing of the resource for wireui select
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function getListForSelect(Request $request)
    {
        $query = Status::query();

        if ($request->has('search'))
        {
            $query->where('name', 'like', $request->get('search').'%');
        }
        elseif ($request->has('selected'))
        {
            $arr = $request->get('selected');
            
            if (!is_numeric($arr[0]))
                $query->where('name', '=', $arr[0]);
            else
                $query->where('id', '=', $arr[0]);
        }

        $rows = $query->select('id', 'name')->get();

        return $rows;
    }


}