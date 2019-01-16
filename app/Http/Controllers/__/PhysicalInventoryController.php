<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Carbon;

class PhysicalInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $stockcards = App\StockCard::where('reference', 'like', '%Physical%')->orWhere('reference', 'like', '%alance%')
                                ->get();
            return datatables($stockcards)->toJson();
        }

        return view('inventory.supply.physical-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print()
    {
        $orientation = "landscape";
        $supplies = App\Supply::all();
        $remaining_rows = $row_count = 0;
        $adjustment = 4;
        $date = Carbon\Carbon::now();

        $data = [
            'supplies' => $supplies,
            'row_count' => $row_count,
            'end' => $remaining_rows,
            'date' => $date
        ];

        $filename = "PhysicalInventory-".Carbon\Carbon::now()->format('mdYHm').".pdf";
        $view = "inventory.supply.print_physical-index";
        return $this->printPreview($view,$data,$filename,$orientation); 
    }
}
