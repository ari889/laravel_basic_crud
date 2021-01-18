<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $students = Student::latest() -> get();
        return view('student.index', [
            'students' => $students
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('student.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id){
        $data = Student::find($id);

        return view('student.show', [
            'student' => $data
        ]);
    }

    public function delete($id){
        $delete_data = Student::find($id);

        $delete_data -> delete();

        return redirect() -> back() -> with('success', 'Student deleted successful.');
    }

    /**
     *
     */
    public function store(Request $request){
        $this -> validate($request, [
            'name' => 'required',
            'email' => 'required | unique:students',
            'uname' => 'required | max:5 | min:2',
            'cell' => 'required',
            'age' => 'required'
        ],[
            'uname.required' => 'Username must not be empty.'
        ]);
        Student::create([
            'name'      => $request -> name,
            'email'     => $request -> email,
            'cell'      => $request -> cell,
            'username'  => $request -> uname,
            'age'       => $request -> age
        ]);

        return redirect() -> back();
    }
}
