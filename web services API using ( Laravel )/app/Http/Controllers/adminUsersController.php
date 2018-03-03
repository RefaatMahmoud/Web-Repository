<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\Users\AdminResource;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return AdminResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Create
        $adminObj  = new User();
        $adminObj->name = $request->name;
        $adminObj->username = $request->username;
        $adminObj->password  = Hash::make($request->password);
        $adminObj->email = $request->email;
        //Save
        $adminObj->save();
        //Response
        return response([
            'data' => new AdminResource($adminObj)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AdminResource(User::find($id));
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
        $adminObj = User::find($id);
        $adminObj->username = $request->username;
        $adminObj->email = $request->email;
        $adminObj->name = $request->name;
        $adminObj->password = Hash::make($request->password);
        $adminObj->save(); //save username
        return response([
            'data' => new AdminResource($adminObj)
        ],\Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
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
        $adminObj = User::find($id);
        $adminObj->delete();
        return response([
            "data" => "Deleted Successfully"
        ],404);
    }
}
