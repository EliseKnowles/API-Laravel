<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Lesson::with(['teacher', 'grade'])->get());
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
            'name'        => 'string|required',
            'start_date'  => 'date|required',
            'end_date'    => 'date|required',
            'teacher_id'  => 'integer|required',
            'grade_id'    => 'integer|required',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $teacher = Teacher::find($request->teacher_id);
        if(!$teacher){
            return response()->json('Teacher not Found' , 404);
        }

        $grade = Grade::find($request->grade_id);
        if(!$grade){
            return response()->json('Grade not Found' , 404);
        }

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if($start_date->diffInDays($end_date) > 5){
            return response()->json('The lesson lasts more than 5 days', 400);
        }

        return response()->json(Lesson::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::where('id', $id)->with(['grade' , 'teacher'])->first();

        if(!$lesson){
            return response()->json('Lesson not Found', 404);
        }

        return response()->json($lesson);
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
        $lesson = Lesson::where('id', $id)->with(['grade' , 'teacher'])->first();

        if(!$lesson){
            return response()->json('Lesson not Found' , 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'string',
            'start_date'  => 'date',
            'end_date'    => 'date',
            'teacher_id'  => 'integer',
            'grade_id'    => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $teacher = Teacher::find($request->teacher_id);
        if(!$teacher){
            return response()->json('Teacher not Found' , 404);
        }

        $grade = Grade::find($request->grade_id);
        if(!$grade){
            return response()->json('Grade not Found' , 404);
        }

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        
        if($start_date->diffInDays($end_date) > 5){
            return response()->json('More than 5 days', 404);
        }

        return response()->json(Lesson::create($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        if(!$lesson){
            return response()->json('Lesson not Found' , 404);
        }

        return response()->json($lesson->delete());
    }
}
