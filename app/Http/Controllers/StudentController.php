<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function listing()
    {
        try {
            $data = DB::table('students')->select('id', 'name', 'email', 'address')->get();
            return view('list', ['data' => $data]);
        } catch (Exception $e) {
            return ($e->getMessage());
        }
    }

    public function add(AddStudentRequest $req)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $studentData = [
                "name" => $req->name,
                "email" => $req->email,
                "address" => $req->address,
            ];
            $res = DB::table('students')->insert($studentData);
            if ($res) {
                // Commit Transaction
                DB::commit();
                $req->session()->flash('Status', 'Student added successfully');
                return redirect('list');
            } else {
                return ("Error in insert statement");
            }
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
            DB::table('students')->delete($id);
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
            $data = DB::table('students')->where('id', $id)->first();
            return view('edit', ['data' => $data]);
        } catch (Exception $e) {
            return ($e->getMessage());
        }
    }

    public function update(UpdateStudentRequest $req)
    {
        // Begin Transaction
        DB::beginTransaction();
        try {
            $data = [
                "name" => $req->name,
                "email" => $req->email,
                "address" => $req->address,
            ];
            $student = DB::table('students')->where('id', $req->id)->update($data);
            if ($student) {
                // Commit Transaction
                DB::commit();
                $req->session()->flash('Status', 'Student updated successfully');
                return redirect('list');
            }
            return ("Error in Update query");
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return ($e->getMessage());
        }
    }
}
