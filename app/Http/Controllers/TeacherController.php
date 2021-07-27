<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Teacher::all());
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
            'name'         => 'required|string',
            'firstname'    => 'required|string',
            'arrival_year' => 'required|integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $name = $request->name;
        $firstname = $request->firstname;

        $teacher = Teacher::where(['name' => $name, 'firstname' => $firstname])->first();
        
        if($teacher){
            return response()->json('Teacher already exists' , 409);
        }
        return response()->json(Teacher::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher){
            return response()->json('Teacher not Found', 404);
        }

        return response()->json($teacher->with('lessons')->get());

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
        $teacher = Teacher::find($id);

        if(!$teacher)
            return response()->json('Teacher not found', 404);

        $validator = Validator::make($request->all(), [
            'name'         => 'string',
            'firstname'    => 'string',
            'arrival_year' => 'integer',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $teacher->update($request->all());

        return response()->json($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        if(!$teacher){
            return response()->json('Teacher not Found' , 404);
        }

        return response()->json($teacher->delete());
    }
}
