<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Users;
use Session;
use Illuminate\Support\Facades\Crypt;

class RestoController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function listing()
    {
        // return view('list');
        $data = Restaurant::select('email')->get();
        foreach ($data as $ele) {
            echo $ele->email;
        }
        // return view('list', ['data' => $data]);
    }

    public function add(Request $req)
    {
        // return $req->input();
        $resto = new Restaurant;
        $resto->name = $req->name;
        $resto->email = $req->email;
        $resto->address = $req->address;
        $resto->save();
        $req->session()->flash('Status', 'Restaurant added successfully');
        return redirect('list');
    }

    public function delete($id)
    {
        Restaurant::find($id)->delete();
        Session::flash('Status', 'Restaurant deleted successfully');
        return redirect('list');
    }

    public function edit($id)
    {
        $data = Restaurant::find($id);
        return view('edit', ['data' => $data]);
        // Session::flash('Status', 'Restaurant deleted successfully');
        // return redirect('list');
    }

    public function update(Request $req)
    {
        // return $req->input();
        $resto = Restaurant::find($req->id);
        $resto->name = $req->name;
        $resto->email = $req->email;
        $resto->address = $req->address;
        $resto->save();
        $req->session()->flash('Status', 'Restaurant updated successfully');
        return redirect('list');
    }
    public function register(Request $req)
    {
        // return $req->input();
        $user = new Users;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Crypt::encrypt($req->password);
        $user->mobile = $req->mobile;
        $user->save();
        $req->session()->put('User', $req->name);
        return redirect('/');

        // return $req->input();
    }

    public function login(Request $req)
    {
        $user = Users::where('email', $req->email)->get();
        if (Crypt::decrypt($user[0]->password) === $req->password) {
            $req->session()->put('User', $user[0]->name);
        }
        return redirect('/');
    }

    public function logout(Request $req)
    {
        $req->session()->forget('User');
        return redirect('/');
    }
}
