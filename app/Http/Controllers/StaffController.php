<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $staff = Staff::latest() -> get();
        return view('staff.index', [
            'staff_all' => $staff
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        return view('staff.create');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id){
        $data = Staff::find($id);
        return view('staff.show', [
            'staff' => $data
        ]);
    }


    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request){
        $this -> validate($request, [
            'name' => 'required',
            'email' => 'required | unique:staff',
            'cell' => 'required | unique:staff',
            'uname' => 'required | min:2 | max:6 | unique:staff',
            'pass' => 'required | min:5',
            'age' => 'required'
        ],[
            'name.required' => 'Name must not be empty.',
            'email.required' => 'Email must not be empty.',
            'cell.required' => 'Cell must not be empty.',
            'pass.required' => 'Password must not be empty.'
        ]);


        $unique_name = '';
        if($request -> hasFile('photo')){
            $file = $request -> file('photo');
            $unique_name = md5(time().rand()).'.'. $file -> getClientOriginalExtension();

            $file -> move(public_path('media/staff'), $unique_name);
        }

        Staff::create([
           'name' => $request -> name,
           'email' => $request -> email,
           'cell' => $request -> cell,
           'uname' => $request -> uname,
           'password' => password_hash($request -> pass, PASSWORD_DEFAULT),
           'age' => $request -> age,
           'photo' => $unique_name,
        ]);
        return redirect() -> back() -> with('success', 'Staff added successfully');
    }

    /**
     * @param $id
     */
    public function delete($id){
        $delete_data = Staff::find($id);
        $delete_data -> delete();

        if(file_exists('media/staff/'.$delete_data -> photo)){
            unlink('media/staff/'.$delete_data -> photo);
        }

        return redirect() -> back() -> with('success', 'Staff deleted successful');
    }

}
