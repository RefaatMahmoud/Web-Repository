<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\InstructorsRequest;
use App\Http\Resources\Users\InstructorsResource;
use App\Instructors;
use Illuminate\Support\Facades\Hash;

class InstructorsController extends Controller
{
    public function index()
    {
        return response([
            "data"=>InstructorsResource::collection(Instructors::all())
        ],200);
    }
    
    public function store(InstructorsRequest $request)
    {
        //create
        $instructorObj = new Instructors();
        $instructorObj->name = $request->name ;
        $instructorObj->username = $request->username;
        $instructorObj->password = Hash::make($request->password);
        $instructorObj->email = $request->email;
        $instructorObj->subjectName = $request->subjectName;
        $instructorObj->telephone = $request->telephone;
        $instructorObj->role = $request->role;
        //save
        $instructorObj->save();
        //response
        return response([
            'data' => new InstructorsResource($instructorObj)
        ],201);
    }


    public function show($id)
    {
        return response([
            'data' => new InstructorsResource(Instructors::find($id))
        ],200);
    }

    public function update(InstructorsRequest $request, $id)
    {
        //Get Student By id
        $instructorObj = Instructors::find($id);
        //update Student
        $instructorObj->update($request->all());
        $instructorObj->telephone = $request->telephone;
        $instructorObj->role = $request->role;
        $instructorObj->password = Hash::make($request->password);
        $instructorObj->save();
        //response
        return response([
            'data' => new InstructorsResource($instructorObj)
        ],200);
    }


    public function destroy($id)
    {
        //Get Student
        $instructorObj = Instructors::find($id);
        $instructorObj->delete();
        return response([
            "data" => "deleted successfully"
        ],200);
    }
}
