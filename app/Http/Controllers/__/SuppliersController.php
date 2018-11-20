<?php

namespace App\Http\Controllers;

use App;
use DB;
use Validator;
use Session;
use Illuminate\Http\Request;

class SuppliersController extends Controller
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
            return json_encode([
                'data' => App\Supplier::all()
            ]);
        }

        return view('maintenance.supplier.index')
            ->with('title','Supplier');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenance.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $this->sanitizeString($request->get('name'));
        $address = $this->sanitizeString($request->get('address'));
        $contact = $this->sanitizeString($request->get('contact'));
        $website = $this->sanitizeString($request->get('website'));
        $email = $this->sanitizeString($request->get('email'));

        $validator = Validator::make([
            'Name' => $name,
            'Address' => $address,
            'Contact' => $contact,
            'Website' => $website,
            'Email' => $email
        ],App\Supplier::$rules);

        if($validator->fails())
        {
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $supplier = new App\Supplier;
        $supplier->name = $name;
        $supplier->address = $address;
        $supplier->contact = $contact;
        $supplier->website = $website;
        $supplier->email = $email;
        $supplier->save();

        \Alert::success('Supplier Added')->flash();
        return redirect('maintenance/supplier');
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
        $supplier = App\Supplier::find($id);

        if( count($supplier) <= 0 )
        {
            \Alert::error('Invalid Supplier Credentials')->flash();
            return redirect('maintenance/supplier');
        }

        return view('maintenance.supplier.edit')
                ->with('title','Supplier')
                ->with('supplier',$supplier);
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
        $name = $this->sanitizeString($request->get('name'));
        $address = $this->sanitizeString($request->get('address'));
        $contact = $this->sanitizeString($request->get('contact'));
        $website = $this->sanitizeString($request->get('website'));
        $email = $this->sanitizeString($request->get('email'));

        $validator = Validator::make([
            'Name' => $name,
            'Address' => $address,
            'Contact' => $contact,
            'Website' => $website,
            'Email' => $email
        ],App\Supplier::$updateRules);

        if($validator->fails())
        {
            return back()
                    ->withInput()
                    ->withErrors($validator);
        }

        $supplier = App\Supplier::find($id);
        $supplier->name = $name;
        $supplier->address = $address;
        $supplier->contact = $contact;
        $supplier->website = $website;
        $supplier->email = $email;
        $supplier->save();

        \Alert::success('Supplier Updated')->flash();
        return redirect('maintenance/supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if($request->ajax())
        {
            $supplier = App\Supplier::find($id);

            if( count($supplier) <= 0 )
            {
                return json_encode('error');
            }

            $supplier->delete();

            return json_encode('success');

        }

        $supplier = App\Supplier::find($id);

        if( count($supplier) <= 0 )
        {
            \Alert::error('Invalid Supplier Credentials')->flash();
            return redirect('maintenance/supplier');
        }

        $supplier->delete();

        \Alert::success('Supplier Removed')->flash();
        return redirect('maintenance/supplier');
    }
}
