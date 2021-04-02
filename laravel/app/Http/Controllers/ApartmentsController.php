<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Apartments;

class ApartmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = DB::table('apartments')
        ->select(
                    'apartments.id',
                    'apartments.block_id',
                    'apartments.code',
                    'apartments.floor',
                    'apartments.acreage',
                    'apartments.total_bedroom',
                    'apartments.total_toilet',
                    'apartments.room_view',
                    'apartments.selling_price',
                    'apartments.rental_price',
                    'apartments.info',
                    'apartments.status'
                )
        ->whereNull('deleted_at')
        ->get();

        return response()->json( compact('apartments') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->input('id');     
        
        $apartment = DB::table('apartments')
        ->select(
            'apartments.id',
            'apartments.block_id',
            'apartments.code',
            'apartments.floor',
            'apartments.acreage',
            'apartments.total_bedroom',
            'apartments.total_toilet',
            'apartments.room_view',
            'apartments.selling_price',
            'apartments.rental_price',
            'apartments.info',
            'apartments.status'
        )
        ->where('apartments.id', '=', $id)
        ->first();

        return response()->json( $apartment );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        
        $apartment = DB::table('apartments')
        ->select(
            'apartments.id',
            'apartments.block_id',
            'apartments.code',
            'apartments.floor',
            'apartments.acreage',
            'apartments.total_bedroom',
            'apartments.total_toilet',
            'apartments.room_view',
            'apartments.selling_price',
            'apartments.rental_price',
            'apartments.info',
            'apartments.status'
        )
        ->where('apartments.id', '=', $id)
        ->first();

        return response()->json( $apartment );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'block_id'      => 'required|min:1|max:20',
            'code'          => 'required|min:1|max:50'
        ]);

        $id = $request->input('id');
        $apartment = Apartments::find($id);
        $apartment->block_id      = $request->input('block_id');
        $apartment->code          = $request->input('code');
        $apartment->floor         = $request->input('floor');
        $apartment->acreage       = $request->input('acreage');
        $apartment->total_bedroom = $request->input('total_bedroom');
        $apartment->total_toilet  = $request->input('total_toilet');
        $apartment->room_view     = $request->input('room_view');
        $apartment->selling_price = $request->input('selling_price');
        $apartment->rental_price  = $request->input('rental_price');
        $apartment->info          = $request->input('info');
        $apartment->status        = $request->input('status');
        $apartment->save();
        // $request->session()->flash('message', 'Successfully updated apartment');
        return response()->json( ['status' => 'success'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');

        $apartment = Apartments::find($id);
        if($apartment){
            $apartment->delete();
        }
        return response()->json( ['status' => 'success'] );
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'block_id'      => 'required|min:1|max:20',
            'code'          => 'required|min:1|max:50'
        ]);

        $apartment = new Apartments();
        $apartment->block_id      = $request->input('block_id');
        $apartment->code          = $request->input('code');
        $apartment->floor         = $request->input('floor');
        $apartment->acreage       = $request->input('acreage');
        $apartment->total_bedroom = $request->input('total_bedroom');
        $apartment->total_toilet  = $request->input('total_toilet');
        $apartment->room_view     = $request->input('room_view');
        $apartment->selling_price = $request->input('selling_price');
        $apartment->rental_price  = $request->input('rental_price');
        $apartment->info          = $request->input('info');
        $apartment->status        = $request->input('status');
        $apartment->save();

        return response()->json( array('success' => true) );
    }
}
