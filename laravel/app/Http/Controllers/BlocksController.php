<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blocks;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = DB::table('blocks')
        ->select('blocks.id', 'blocks.department_id', 'blocks.name', 'blocks.info')
        ->whereNull('deleted_at')
        ->get();
        foreach($blocks as $block){
            $block->departments_name = '';
            $departments = DB::table('departments')->select('departments.id', 'departments.name')->where('departments.id', '=', $block->department_id)->first();
            $block->departments_name = $departments->name;          
        }           
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
        ->select('blocks.id', 'blocks.name', 'blocks.info', 'blocks.department_id')
        ->where('blocks.id', '=', $id)
        ->first();

        $departments = DB::table('departments')->select('departments.id', 'departments.name')->where('departments.id', '=', $block->department_id)->first();
        $block->department_name = $departments->name;
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
            ->select('blocks.id', 'blocks.department_id', 'blocks.name', 'blocks.info')
            ->where('blocks.id', '=', $id)
            ->first();
        }
        $departments = DB::table('departments')->select('departments.id', 'departments.name')->whereNull('deleted_at')->get();
        $data = [
            'block' => $block,
            'departments'=> $departments,
        ];
        return response()->json( $data );
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
            'name'          => 'required|min:1|max:50',
            'department_id' => 'required'
        ]);

        $id = $request->input('id');
        $block = Blocks::find($id);
        $block->department_id   = $request->input('department_id');
        $block->name            = $request->input('name');
        $block->info            = $request->input('info');    
        $block->save();
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
        $validatedData = $request->validate([
            'name' => 'required|min:1|max:50',
            'department_id' => 'required'
        ]);

        $block = new Blocks();
        $block->department_id   = $request->input('department_id');
        $block->name            = $request->input('name');
        $block->info            = $request->input('info'); 
        $block->save();

        return response()->json( ['status' => 'success'] );
    }
}