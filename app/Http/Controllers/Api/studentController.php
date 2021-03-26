<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\studentResource;
use Illuminate\Http\Request;
use App\Models\Student;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $student =  DB::table('students')->get();
//        return response()->json($student);

//        return Student::all();
        $newStudent =  Student::all();
        return studentResource::collection($newStudent);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|unique:students|max:255',
        ]);
        $addStudent = Student::create($validated);
        if ($addStudent){
            return ["addStudent" => "Add Student Name."];
        }else{
            return ["addStudent" => "Something wrong."];
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
       $student = Student::where('id', $id)->first();

        return response($student);

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
        $update = Student::findOrFail($id);
        $update->student_name = $request->student_name;
        if ($update->save()){
            return response('updated');
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
        Student::where('id', $id)->delete();

        return response('deleted');
    }
}
