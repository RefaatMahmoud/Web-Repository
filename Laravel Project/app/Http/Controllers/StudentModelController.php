<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StudentRequest;
use App\Http\Resources\Users\StudentsResource;
use App\StudentModel;
use Illuminate\Support\Facades\Hash;

class StudentModelController extends Controller
{

    public function index()
    {
        return response([
            "student" => StudentsResource::collection(StudentModel::all())
        ],200);
    }

    public function store(StudentRequest $request)
    {
        //create
        $studentObj = new StudentModel();
        $studentObj->name = $request->name ;
        $studentObj->username = $request->username;
        $studentObj->password = Hash::make($request->password);
        $studentObj->email = $request->email;
        $studentObj->level = $request->level;
        $studentObj->telephone = $request->telephone;
        $studentObj->role = $request->role;
        //save
        $studentObj->save();
        //response
        return response([
            'student' => new StudentsResource($studentObj)
        ],201);
    }

    public function show($id)
    {
        return response([
            'student' => new StudentsResource(StudentModel::find($id))
        ],200);
    }

    public function update(StudentRequest $request, $id)
    {
        //Get Student By id
        $studentObj = StudentModel::find($id);
        //update Student
        $studentObj->update($request->all());
        $studentObj->password = Hash::make($request->password);
        $studentObj->save();
        //response
        return response([
            'student' => new StudentsResource($studentObj)
        ],200);
    }

    public function destroy($id)
    {
        //Get Student
        $studentObj = StudentModel::find($id);
        $studentObj->delete();
        return response([
            "student" => "deleted successfully"
        ],200);
    }
}
