<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $teacher = Teacher::all();
        return view('teacher.index', [
            'all_teacher' => $teacher,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('teacher.create');
    }

    public function store(Request $request){
        $this -> validate($request, [
           'name' => 'required',
           'email' => 'required | unique:teachers',
            'cell' => 'required | unique:teachers',
            'username' => 'required | min:2 | max:6 | unique:teachers',
            'password' => 'required',
            'age' => 'required'
        ],[
            'username.required' => 'Username must not be empty.'
        ]);

        Teacher::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'cell' => $request -> cell,
            'password' => password_hash($request -> cell, PASSWORD_DEFAULT),
            'username' => $request -> username,
            'age' => $request -> age,
        ]);

        return redirect() -> back() -> with('success', 'Teacher added successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id){
        $data = Teacher::find($id);
        return view('teacher.show', [
            'teacher' => $data
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        $data = Teacher::find($id);

        $data -> delete();

        return redirect() -> back() -> with('success', 'Teacher deleted successfully');
    }
}
