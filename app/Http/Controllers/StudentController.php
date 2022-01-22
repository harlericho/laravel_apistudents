<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Http\Requests\EditRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json([Student::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        //
        if ($request->hasFile('photo')) {
            // $path = $request->file('photo')->store('public/images');
            $path = $request->dni . '_' . time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images', $path);
        } else {
            $path = 'default.jpg';
        }
        Student::create([
            'dni' => $request->dni,
            'names' => $request->names,
            'email' => $request->email,
            'age' => $request->age,
            'photo' => $path,
        ]);
        // Student::create($request->all());
        return response()->json([
            'message' => 'Student created',
            'student' => true
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        return response()->json([
            'message' => true,
            'student' => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Student $student)
    {
        //
        // $student = Student::find($student->id);
        if ($request->hasFile('photo')) {
            if ($student->photo != 'default.png') {
                $path = $request->dni . '_' . time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/images', $path);
                Storage::delete('public/images/' . $student->photo);
            } else {
                $path = $request->dni . '_' . time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/images', $path);
            }
        }

        // $student->dni = $request->dni;
        // $student->names = $request->names;
        // $student->email = $request->email;
        // $student->age = $request->age;
        // $student->photo = $path ?? $student->photo;
        // $student->save();

        $student->update([
            'dni' => $request->dni ?? $student->dni,
            'names' => $request->names ?? $student->names,
            'email' => $request->email ?? $student->email,
            'age' => $request->age ?? $student->age,
            'photo' => $path ?? $student->photo,
        ]);
        //$student->update($request->all());


        return response()->json([
            'message' => 'Student updated',
            'student' => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        if ($student->photo != 'default.png') {
            Storage::delete('public/images/' . $student->photo);
        }
        $student->delete();
        return response()->json([
            'message' => 'Student deleted',
            'student' => $student
        ], 200);
    }
}
