<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function getValidator($data)
    {
        $now_date = Carbon::now()->format('Y-m-d');
        $data['now_date'] = $now_date;
        $birth_day = date('Y-m-d', strtotime($data['birth_day']));
        return Validator::make($data, [
            'full_name'     => ['required', 'min:1' , 'max:256'],
            'email'         => ['required', 'email' , 'max:256'],
            'phone'         => ['required', 'min:10', 'max:10'],
            'identity_card' => ['max:20'],
            'birth_day'     => ['required',
                                ($now_date != "" && $birth_day != "" && $birth_day >= $now_date ? 'before:now_date' : ''),
                               ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $you = auth()->user()->id;
        $users = DB::table('users')
        ->select('users.id', 'users.full_name', 'users.short_name', 'users.email', 'users.menuroles as roles', 'users.status', 'users.email_verified_at as registered')
        ->whereNull('deleted_at')
        ->get();
        return response()->json(compact('users', 'you'));
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

        $user = DB::table('users')
        ->select('users.id', 'users.full_name', 'users.short_name', 'users.status',
                 'users.email', 'users.phone', 'users.identity_card',
                 'users.birth_day', 'users.gender', 'users.menuroles as roles',
                 'users.face_book', 'users.note',
                 'users.email_verified_at as registered', 'users.images')
        ->where('users.id', '=', $id)
        ->first();
        if($user){
            $user->gender = $user->gender == 0 ? "Woman" : ($user->gender == 1 ? "Man" : "Undefined");
        }
        return response()->json( $user );
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

        $user = DB::table('users')
        ->select('users.id', 'users.full_name', 'users.short_name',
                 'users.email', 'users.phone', 'users.identity_card',
                 'users.birth_day', 'users.gender', 'users.menuroles as roles',
                 'users.face_book', 'users.note', 'users.menuroles', 'users.status', 'users.images')
        ->where('users.id', '=', $id)
        ->first();
        return response()->json( $user );
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
        if (!$request->ajax() && !$request->wantsJson()) {
            return response()->json([], 500);
        }
        $data = $request->all();

        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            return response()->json( [
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray()]
            );
        } else {
            $id                  = $request->input('id');
            $user                = User::find($id);
            $user->full_name     = $request->input('full_name');
            $user->short_name    = $request->input('short_name');
            $user->phone         = $request->input('phone');
            $user->identity_card = $request->input('identity_card');
            $user->birth_day     = $request->input('birth_day');
            if(count($request->input('images')) > 0){
                $user->images        = $request->input('images')[0]['path'];
            }
            $user->gender        = $request->input('gender') == "Man" ? 1 : ($request->input('gender') == "Woman" ? 0 : 2);
            $user->face_book     = $request->input('face_book');
            $user->note          = $request->input('note');
            $user->email         = $request->input('email');
            $user->menuroles     = $request->input('menuroles');
            $user->status        = $request->input('status');
            $user->save();
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

        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return response()->json( ['status' => 'success'] );
    }

        /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request){
        if (!$request->ajax() && !$request->wantsJson()) {
            return response()->json([], 500);
        }
        $data = $request->all();
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            return response()->json( [
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray()]
            );
        } else {
            $email_error = DB::table('users')->select('users.email')->where('users.email', '=', $request->input('email'))->first();
            if($email_error != null){
                return response()->json( [
                    'status' => 'error',
                    'errors' => [ 'email' => ['This email already exists, please check again']]]
                );
            }else{
                $user                    = new User();
                $user->full_name         = $request->input('full_name');
                $user->short_name        = $request->input('short_name');
                $user->phone             = $request->input('phone');
                $user->identity_card     = $request->input('identity_card');
                $user->birth_day         = $request->input('birth_day');
                $user->gender            = $request->input('gender');
                $user->face_book         = $request->input('face_book');
                $user->note              = $request->input('note');
                if(count($request->input('images')) > 0){
                    $user->images        = $request->input('images')[0]['path'];
                }
                $user->email             = $request->input('email');
                $user->email_verified_at = Carbon::now();
                $user->password          = bcrypt($request->input('password'));
                $user->menuroles         = $request->input('menuroles');
                $user->status            = $request->input('status');
                $user->save();

                return response()->json( array('success' => true) );
            }
        }
    }
}
