<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Apartments;
use Validator;

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
     * getValidator
     *
     */
    protected function getValidator($data)
    {
        return Validator::make($data, [
            'block_id'          => ['required'],
            'user_id'           => ['required'],
            'code'              => ['required', 'min:1', 'max:50'],
            'selling_price'     => ['required', 'min:1', 'max:20'],
            'rental_price'      => ['required', 'min:1', 'max:20'],
            'floor'             => ['required'],
            'acreage'           => ['required'],
        ]);
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
                    'blocks.name as block_name',
                    'apartments.user_id',
                    'users.full_name as user_name',
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
        ->whereNull('apartments.deleted_at')
        ->join('blocks', 'apartments.block_id', '=' ,'blocks.id')
        ->leftJoin('users', 'apartments.user_id', '=' ,'users.id')
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
            'blocks.name as block_name',
            'apartments.user_id',
            'users.full_name as user_name',
            'apartments.code',
            'apartments.floor',
            'apartments.acreage',
            'apartments.total_bedroom',
            'apartments.total_toilet',
            'apartments.room_view',
            'apartments.selling_price',
            'apartments.rental_price',
            'apartments.info',
            'apartments.status',
            'apartments.image_1',
            'apartments.image_2',
            'apartments.image_3',
            'apartments.image_4',
            'apartments.image_5',
            'apartments.image_6',
            'apartments.image_7',
            'apartments.image_8',
            'apartments.image_9',
            'apartments.image_10'
        )
        ->where('apartments.id', '=', $id)
        ->join('blocks', 'apartments.block_id', '=' ,'blocks.id')
        ->leftJoin('users', 'apartments.user_id', '=' ,'users.id')
        ->first();
        $images = array();
        $images = $this->pushArrayImage($apartment->image_1, $images);
        $images = $this->pushArrayImage($apartment->image_2, $images);
        $images = $this->pushArrayImage($apartment->image_3, $images);
        $images = $this->pushArrayImage($apartment->image_4, $images);
        $images = $this->pushArrayImage($apartment->image_5, $images);
        $images = $this->pushArrayImage($apartment->image_6, $images);
        $images = $this->pushArrayImage($apartment->image_7, $images);
        $images = $this->pushArrayImage($apartment->image_8, $images);
        $images = $this->pushArrayImage($apartment->image_9, $images);
        $images = $this->pushArrayImage($apartment->image_10, $images);
        $apartment->images = $images;
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
            'blocks.name as block_name',
            'apartments.user_id',
            'users.full_name as user_name',
            'apartments.code',
            'apartments.floor',
            'apartments.acreage',
            'apartments.total_bedroom',
            'apartments.total_toilet',
            'apartments.room_view',
            'apartments.selling_price',
            'apartments.rental_price',
            'apartments.info',
            'apartments.status',
            'apartments.image_1',
            'apartments.image_2',
            'apartments.image_3',
            'apartments.image_4',
            'apartments.image_5',
            'apartments.image_6',
            'apartments.image_7',
            'apartments.image_8',
            'apartments.image_9',
            'apartments.image_10'
        )
        ->where('apartments.id', '=', $id)
        ->join('blocks', 'apartments.block_id', '=' ,'blocks.id')
        ->leftJoin('users', 'apartments.user_id', '=' ,'users.id')
        ->first();
        $images = array();
        $images = $this->pushArrayImage($apartment->image_1, $images);
        $images = $this->pushArrayImage($apartment->image_2, $images);
        $images = $this->pushArrayImage($apartment->image_3, $images);
        $images = $this->pushArrayImage($apartment->image_4, $images);
        $images = $this->pushArrayImage($apartment->image_5, $images);
        $images = $this->pushArrayImage($apartment->image_6, $images);
        $images = $this->pushArrayImage($apartment->image_7, $images);
        $images = $this->pushArrayImage($apartment->image_8, $images);
        $images = $this->pushArrayImage($apartment->image_9, $images);
        $images = $this->pushArrayImage($apartment->image_10, $images);
        $apartment->images = $images;
        return response()->json( $apartment );
    }

    /**
     * push path image
     *
     */
    public function pushArrayImage($path, $images)
    {
        if($path && $path != ""){
            array_push($images, $path);
        }
        return $images;
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
        $data = $request->all();
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            return response()->json( [
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray()]
            );
        } else {
            $id = $request->input('id');
            $apartment = Apartments::find($id);
            $apartment->block_id      = $request->input('block_id');
            $apartment->user_id       = $request->input('user_id');
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

            if($request->input('images')){
                if(count($request->input('images')) > 0){
                    $apartment->image_1 = $request->input('images')[0];
                }
                if(count($request->input('images')) > 1){
                    $apartment->image_2 = $request->input('images')[1];
                }
                if(count($request->input('images')) > 2){
                    $apartment->image_3 = $request->input('images')[2];
                }
                if(count($request->input('images')) > 3){
                    $apartment->image_4 = $request->input('images')[3];
                }
                if(count($request->input('images')) > 4){
                    $apartment->image_5 = $request->input('images')[4];
                }
                if(count($request->input('images')) > 5){
                    $apartment->image_6 = $request->input('images')[5];
                }
                if(count($request->input('images')) > 6){
                    $apartment->image_7 = $request->input('images')[6];
                }
                if(count($request->input('images')) > 7){
                    $apartment->image_8 = $request->input('images')[7];
                }
                if(count($request->input('images')) > 8){
                    $apartment->image_9 = $request->input('images')[8];
                }
                if(count($request->input('images')) > 9){
                    $apartment->image_10 = $request->input('images')[9];
                }
            }
            $apartment->save();
            // $request->session()->flash('message', 'Successfully updated apartment');
            return response()->json( ['status' => 'success'] );
        }
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
        $data = $request->all();
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            return response()->json( [
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray()]
            );
        } else {
            $apartment = new Apartments();
            $apartment->block_id      = $request->input('block_id');
            $apartment->user_id       = $request->input('user_id');
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

            if($request->input('images')){
                if(count($request->input('images')) > 0){
                    $apartment->image_1 = $request->input('images')[0];
                }
                if(count($request->input('images')) > 1){
                    $apartment->image_2 = $request->input('images')[1];
                }
                if(count($request->input('images')) > 2){
                    $apartment->image_3 = $request->input('images')[2];
                }
                if(count($request->input('images')) > 3){
                    $apartment->image_4 = $request->input('images')[3];
                }
                if(count($request->input('images')) > 4){
                    $apartment->image_5 = $request->input('images')[4];
                }
                if(count($request->input('images')) > 5){
                    $apartment->image_6 = $request->input('images')[5];
                }
                if(count($request->input('images')) > 6){
                    $apartment->image_7 = $request->input('images')[6];
                }
                if(count($request->input('images')) > 7){
                    $apartment->image_8 = $request->input('images')[7];
                }
                if(count($request->input('images')) > 8){
                    $apartment->image_9 = $request->input('images')[8];
                }
                if(count($request->input('images')) > 9){
                    $apartment->image_10 = $request->input('images')[9];
                }
            }
            $apartment->save();
            return response()->json( array('success' => true) );
        }
    }

    /**
     * Display a listing of the resource for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $blocks = DB::table('blocks')
        ->select(
                    'blocks.id',
                    'blocks.department_id',
                    'blocks.name',
                    'blocks.info'
                )
        ->whereNull('blocks.deleted_at')
        ->get();

        return response()->json( compact('blocks') );
    }
}
