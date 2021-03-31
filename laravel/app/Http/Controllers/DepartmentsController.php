<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departments;

class DepartmentsController extends Controller
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
        $departments = DB::table('departments')
        ->select('departments.id', 'departments.name', 'departments.total_floor', 'departments.total_block')
        ->whereNull('deleted_at')
        ->get();

        return response()->json( compact('departments') );
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
        
        $department = DB::table('departments')
        ->select('departments.id', 'departments.name', 'departments.total_floor', 'departments.total_block')
        ->where('departments.id', '=', $id)
        ->first();

        return response()->json( $department );
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
        
        $department = DB::table('departments')
        ->select('departments.id', 'departments.name', 'departments.total_floor', 'departments.total_block')
        ->where('departments.id', '=', $id)
        ->first();

        return response()->json( $department );
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
            'name'        => 'required|min:1|max:50',
            'total_floor' => 'min:1|max:99',
            'total_block' => 'min:1|max:99'
        ]);

        $id = $request->input('id');
        $department = Departments::find($id);
        $department->name        = $request->input('name');
        $department->total_floor = $request->input('total_floor');
        $department->total_block = $request->input('total_block');
        $department->save();
        //$request->session()->flash('message', 'Successfully updated department');
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

        $department = Departments::find($id);
        if($department){
            $department->delete();
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
            'name' => 'required|min:1|max:50',
            'total_floor' => 'min:1|max:99',
            'total_block' => 'min:1|max:99'
        ]);

        $department = new Departments();
        $department->name = $request->input('name');
        $department->total_floor = $request->input('total_floor');
        $department->total_block = $request->input('total_block');
        $department->save();

        return response()->json( array('success' => true) );
    }
}
