<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
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
        $validator = Validator::make($request->all(), [
            'name'         => 'string|required',
            'firstname'    => 'string|required',
            'age'          => 'integer|required',
            'arrival_year' => 'integer|required',
            'grade_id'     => 'integer|required',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $grade = Grade::find($request->grade_id);
        if(!$grade){
            return response()->json('Grade not Found' , 404);
        }
        return response()->json(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::where('id', $id)->with(['grade', 'marks'])->first();

        if(!$student){
            return response()->json('Student not Found', 404);
        }

        return response()->json($student);
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
        $student = Student::where('id', $id)->with('grade')->first();
        if(!$student){
            return response()->json('Student not Found' , 404);
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'string',
            'firstname'    => 'string',
            'age'          => 'integer',
            'arrival_year' => 'integer',
            'grade_id'     => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $grade = Grade::find($request->grade_id);
        if(!$grade){
            return response()->json('Grade not Found' , 404);
        }

        return response()->json($student->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if(!$student)
            return response()->json('Student not found!', 404);

        return response()->json($student->delete());
    }
}
