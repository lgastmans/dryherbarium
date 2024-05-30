<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Family;

class FamilyController extends Controller
{

    /**
     * Display a listing of the resource. 
     */
    public function index(): View
    {
        return view('families', [
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
        $query = Family::query();

        if ($request->has('search'))
        {
            $query->where('family', 'like', $request->get('search').'%');
        }
        elseif ($request->has('selected'))
        {
            $arr = $request->get('selected');
            
            if (!is_numeric($arr[0]))
                $query->where('family', '=', $arr[0]);
            else
                $query->where('id', '=', $arr[0]);
        }

        $rows = $query->select('id', 'family')->get();

        return $rows;
    } 
}
