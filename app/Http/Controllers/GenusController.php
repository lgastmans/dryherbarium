<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Genus;
use App\Models\Herbarium;

class GenusController extends Controller
{

    /**
     * Display a listing of the resource. 
     */
    public function index(): View
    {
        return view('genus', [
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
        $query = Genus::query();

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

    public function generateLabel($id)
    {

        //$id = $request->has('id');

        $herbarium = Herbarium::find($id);

        $data = [
            'title' => 'Herbarium',
            'address' => 'Auroville, Tamil Nadu, India',
            'herbarium' => $herbarium,
        ];

        $pdf = Pdf::loadView('herbarium-label', $data);
        $pdf->setPaper('A4', 'landscape');
        // return $pdf->download('herbarium-label.pdf');

        return view('herbarium-label', $data);

        /*
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'name.pdf');
        */
    }

    public function generateLabelView($id)
    {

        //$id = $request->has('id');

        $herbarium = Herbarium::find($id);

        $data = [
            'title' => 'Herbarium',
            'address' => 'Auroville, Tamil Nadu, India',
            'herbarium' => $herbarium,
        ];

        return view('herbarium-label', $data);
    }

}
