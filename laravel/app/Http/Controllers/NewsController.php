<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use Validator;

class NewsController extends Controller
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
            'category_id'   => ['required'], 
            'title'         => ['required'],
            'header'        => ['required'],
            'body'          => ['required'],
            'footer'        => ['required'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = DB::table('news')
        ->select('news.id', 'news.category_id', 'category.name as category_name', 'news.title', 'news.header', 'news.body', 'news.footer')
        ->join('category', 'category.id', '=' ,'news.category_id')
        ->whereNull('news.deleted_at')
        ->get();     
        return response()->json(compact('news'));
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
        
        $news = DB::table('news')
        ->select('news.id', 'news.category_id', 'category.name as category_name', 'news.title', 'news.header', 'news.body', 'news.footer', 'news.image')
        ->join('category', 'category.id', '=' ,'news.category_id')
        ->where('news.id', '=', $id)
        ->first();
        return response()->json($news);
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
        $news = null;
        if($id != ''){
            $news = DB::table('news')
            ->select('news.id', 'news.category_id', 'category.name as category_name', 'news.title', 'news.header', 'news.body', 'news.footer', 'news.image')
            ->join('category', 'category.id', '=' ,'news.category_id')
            ->where('news.id', '=', $id)
            ->first();
        }
        return response()->json($news);
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
            $new = News::find($id);
            $new->category_id   = $request->input('category_id');
            $new->title         = $request->input('title');
            $new->header        = $request->input('header');
            $new->body          = $request->input('body');
            $new->footer        = $request->input('footer');
            $new->image         = $request->input('image');
            $new->save();
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

        $new = News::find($id);
        if($new){
            $new->delete();
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
            $new = new News();
            $new->category_id   = $request->input('category_id');
            $new->title         = $request->input('title');
            $new->header        = $request->input('header');
            $new->body          = $request->input('body');
            $new->footer        = $request->input('footer');
            $new->image         = $request->input('image');
            $new->save();
            return response()->json( ['status' => 'success'] );
        }
    }
}