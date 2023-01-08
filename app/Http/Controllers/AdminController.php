<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('user')->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.admin.index' , compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return response()->view('cms.admin.create' , compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'email'=> 'required|email',
        ],[
            'email.required' =>"Please enter email !",
            'email.email' =>"Please enter email example email@gmail.com !",
        ]
    
    );

        if(! $validator->fails()){
            $admins = new Admin();
            $admins->email = request()->get('email');
            $admins->password = Hash::make($request->get('password'));

            $isSaaved = $admins->save();
            if ($isSaaved) {
                $users = new User();
                $users->first_name = request()->get('first_name');
                $users->last_name = request()->get('last_name');
                $users->mobile = request()->get('mobile');
                $users->address = request()->get('address');
                $users->date_of_birth = request()->get('date_of_birth');
                $users->gender = request()->get('gender');
                $users->status = request()->get('status');
                $users->city_id = request()->get('city_id');
                $users->actor()->associate($admins);
            
                $isSaaved = $users->save();
                if ($isSaaved) {

                return response()->json([
                'icon' => 'success' ,
                'title' => "created is successfully"
                ] , 200);
                }
                else{
                    return response()->json([
                        'icon' => 'error' ,
                        'title' => "created is Failed"
                        ] , 400);
                } 
            } 
        }
        else{
            return response()->json(['icon' => 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        $cities = City::all();
        return response()->view('cms.admin.edit' , compact('cities' , 'admins'));

        
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
        $validator = Validator($request->all(),[
            'email'=> 'required|email',
        ],[
            'email.required' =>"Please enter email !",
            'email.email' =>"Please enter email example email@gmail.com !",
        ]
    
    );

        if(! $validator->fails()){
            $admins = Admin::findOrFail();
            $admins->email = request()->get('email');
            $admins->password = Hash::make($request->get('password'));

            $isUpdate = $admins->save();

            if ($isUpdate) {
                $users = $admins->user;
                $users->first_name = request()->get('first_name');
                $users->last_name = request()->get('last_name');
                $users->mobile = request()->get('mobile');
                $users->address = request()->get('address');
                $users->date_of_birth = request()->get('date_of_birth');
                $users->gender = request()->get('gender');
                $users->status = request()->get('status');
                $users->city_id = request()->get('city_id');
                $users->actor()->associate($admins);
            
                $isUpdate = $users->save();
                return ['redirect' =>route('admins.index')];
                if ($isUpdate) {

                return response()->json([
                'icon' => 'success' ,
                'title' => "created is successfully"
                ] , 200);
                }
                else{
                    return response()->json([
                        'icon' => 'error' ,
                        'title' => "created is Failed"
                        ] , 400);
                } 
            } 
        }
        else{
            return response()->json(['icon' => 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admins = Admin::destroy($id);
    }
}
