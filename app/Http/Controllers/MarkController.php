<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Mark::with(['student', 'lesson'])->get());
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
            'value'       => 'integer|required|between:0,20',
            'student_id'  => 'integer|required',
            'lesson_id'   => 'integer|required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $student = Student::find($request->student_id);
        if(!$student){
            return response()->json('Student not Found' , 404);
        }

        $lesson = Lesson::find($request->lesson_id);
        if(!$lesson){
            return response()->json('Lesson not Found' , 404);
        }

        return response()->json(Mark::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mark = Mark::where('id', $id)->with(['student', 'lesson'])->first();

        if(!$mark)
            return response()->json('Mark not found', 404);

        return response()->json($mark);
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
        $mark = Mark::where('id', $id)->with(['student', 'lesson'])->first();
        
        if(!$mark){
            return response()->json('Mark not Found' , 404);
        }

        $validator = Validator::make($request->all(), [
            'mark'        => 'integer|between:0,20',
            'student_id'  => 'integer',
            'lesson_id'   => 'integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $student = Student::find($request->student_id);
        if(!$student){
            return response()->json('Student not Found' , 404);
        }

        $lesson = Lesson::find($request->lesson_id);
        if(!$lesson){
            return response()->json('Lesson not Found' , 404);
        }

        return response()->json($mark->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mark = Mark::find($id);
        if(!$mark){
            return response()->json('Mark not Found' , 404);
        }

        return response()->json($mark->delete());
    }
}
