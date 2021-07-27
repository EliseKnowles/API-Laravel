<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Grade::all());
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
            'name'            => 'required',
            'promotion_year'  => 'integer|required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $name = $request->name;
        $promotion_year = $request->promotion_year;

        $grade = Grade::where(['name' => $name ,'promotion_year', $promotion_year])->first();

        if($grade){
            return response()->json('This grade already exist' , 409);
        }

        return response()->json(Grade::create($request->all()));
    }

    /**
     * Display the specified resource. // Relationship
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade = Grade::find($id);

        if(!$grade){
            return response()->json('Grade not found', 404);
        }

        return response()->json($grade->with('students')->get());
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
        $grade = Grade::find($id);
        if(!$grade){
            return response()->json('Grade not Found' , 404);
        }

        $validator = Validator::make($request->all(), [
            'name'           => 'string',
            'promotion_year' => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        return response()->json($grade->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        if(!$grade){
            return response()->json('Grade not Found' , 404);
        }

        return response()->json($grade->delete());
    }
}
