<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blocks;
use Validator;

class BlocksController extends Controller
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
            'department_id'   => ['required'],
            'name'            => ['required', 'max:50'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = DB::table('blocks')
        ->select('blocks.id', 'blocks.department_id', 'departments.name as department_name', 'blocks.name')
        ->join('departments', 'departments.id', '=' ,'blocks.department_id')
        ->whereNull('blocks.deleted_at')
        ->get();
        return response()->json( compact('blocks') );
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

        $block = DB::table('blocks')
        ->select('blocks.id', 'blocks.department_id', 'departments.name as department_name', 'blocks.name', 'blocks.info')
        ->join('departments', 'departments.id', '=' ,'blocks.department_id')
        ->where('blocks.id', '=', $id)
        ->first();
        return response()->json( $block);
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
        $block = null;
        if($id != ''){
            $block = DB::table('blocks')
            ->select('blocks.id', 'blocks.department_id', 'departments.name as department_name', 'blocks.name', 'blocks.info')
            ->join('departments', 'departments.id', '=' ,'blocks.department_id')
            ->where('blocks.id', '=', $id)
            ->first();
        }
        return response()->json( $block );
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
            $block = Blocks::find($id);
            $block->department_id   = $request->input('department_id');
            $block->name            = $request->input('name');
            $block->info            = $request->input('info');
            $block->save();
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

        $block = Blocks::find($id);
        if($block){
            $block->delete();
        }
        return response()->json( ['status' => 'success'] );
    }

    /**
     * [store]
     * @param  Request $request
     * @return
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
            $block = new Blocks();
            $block->department_id   = $request->input('department_id');
            $block->name            = $request->input('name');
            $block->info            = $request->input('info');
            $block->save();
            return response()->json( ['status' => 'success'] );
        }
    }
}