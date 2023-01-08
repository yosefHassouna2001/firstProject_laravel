<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\City;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $authors = Author::orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.author.index' , compact('authors'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return response()->view('cms.author.create' , compact('cities'));
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
            'first_name'=> 'required|string|min:3|max:20',
            'last_name' => 'required',
            'email' => 'required',
        ],[
            'first_name.required' =>"Please enter first name !",
            'last_name.required' =>"Please enter last name !",
            'email.required' =>"Please enter email !",
        ]
    
    );

        if(! $validator->fails()){
            $authors = new Author();
            $authors->first_name = request()->get('first_name');
            $authors->last_name = request()->get('last_name');
            $authors->email = request()->get('email');
            $authors->password = request()->get('password');
            $authors->mobile = request()->get('mobile');
            $authors->address = request()->get('address');
            $authors->date_of_birth = request()->get('date_of_birth');
            $authors->gender = request()->get('gender');
            $authors->status = request()->get('status');
            // $authors->image = request()->get('image');
            $authors->city_id = request()->get('city_id');


            $isSaved = $authors->save();
            if ($isSaved) {
            return response()->json(['icon' => 'success' , 'title' => "created is successfully"] , 200);

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
}
