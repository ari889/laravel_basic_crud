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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){
        $all_data = Staff::find($id);
        return view('staff.edit', [
            'staff' => $all_data
        ]);
    }

    public function update(Request $request, $id){
        $update_data = Staff::find($id);

        $this -> validate($request, [
            'name' => 'required',
            'email' => 'required',
            'cell' => 'required',
            'uname' => 'required | min:2 | max:6',
            'age' => 'required'
        ],[
            'name.required' => 'Name must not be empty.',
            'email.required' => 'Email must not be empty.',
            'cell.required' => 'Cell must not be empty.',
            'pass.required' => 'Password must not be empty.'
        ]);

        if($request -> hasFile('new_photo')){
            $file = $request -> file('new_photo');
            $unique_name = md5(time().rand()).'.'.$file -> getClientOriginalExtension();
            $file -> move(public_path('media/staff'), $unique_name);

            if(file_exists('media/staff/'.$request -> old_photo)){
                unlink('media/staff/'.$request -> old_photo);
            }
        }else{
            $unique_name = $request -> old_photo;
        }

        $update_data -> name = $request -> name;
        $update_data -> email = $request -> email;
        $update_data -> cell = $request -> cell;
        $update_data -> uname = $request -> uname;
        $update_data -> age = $request -> age;
        $update_data -> photo = $unique_name;
        $update_data -> update();

        return redirect() -> back() -> with('success', 'Data updated successful');
    }

}
