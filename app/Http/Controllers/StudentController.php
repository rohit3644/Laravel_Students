<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Exception;
use Session;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function listing()
    {

        try {
            $data = Student::select('id', 'name', 'email', 'address')->get();
            return view('list', ['data' => $data]);
        } catch (Exception $e) {
            return ($e->getMessage());
        }
    }

    public function add(Request $req)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $student = new Student;
            $student->name = $req->name;
            $student->email = $req->email;
            $student->address = $req->address;
            $student->save();
            // Commit Transaction
            DB::commit();
            $req->session()->flash('Status', 'Student added successfully');
            return redirect('list');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return ($e->getMessage());
        }
    }

    public function delete($id)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            Student::find($id)->delete();
            // Commit Transaction
            DB::commit();
            Session::flash('Status', 'Student deleted successfully');
            return redirect('list');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return ($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $data = Student::find($id);
            return view('edit', ['data' => $data]);
        } catch (Exception $e) {
            return ($e->getMessage());
        }
    }

    public function update(Request $req)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $student = Student::find($req->id);
            $student->name = $req->name;
            $student->email = $req->email;
            $student->address = $req->address;
            $student->save();
            // Commit Transaction
            DB::commit();
            $req->session()->flash('Status', 'Student updated successfully');
            return redirect('list');
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return ($e->getMessage());
        }
    }
}
