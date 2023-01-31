<?php

namespace App\Http\Controllers;

use App\AksesModel;
use App\UserModel;
use Auth;
use Illuminate\Http\Request;
use Str;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $r)
    {
        //dd($r->all());
        if (Auth::attempt($r->only('email', 'password'))) {
            if (Auth::check()) {
                $get = AksesModel::where('user_id', auth()->user()->id)->get();
                foreach ($get as $k) {
                    $r->session()->put($k->akses, $k->akses);
                }

            }
            return redirect('beranda');
        }
        return redirect('login');
    }
  
    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->flush();
        return redirect('/login');
    }
    public function index()
    {
        $data = array(
            "title" => "Login"
        );
        return view('login',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            "title" => "Form Registrasi"
        );
        return view('registrasi',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    { 
        $r->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $post = $r->all();
        $post["password"] = bcrypt($post["password"]);
        $post["level"] = "user";
        $post["remember_token"] = Str::random(60);
        $post["image"] = 'assets/user/no_photo.png';
        
        $sv = UserModel::create($post);
        $result = array();
        if ($sv) {
            $result["success"] = "Berhasil Registrasi";
        }else{
            $result["error"] = "Gagal Registrasi";
        }

        return redirect('login')->with($result); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}