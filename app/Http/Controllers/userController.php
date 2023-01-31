<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;
use Str;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user', ['title' => 'User Master']);
    }

    public function table()
    {

        $list = UserModel::all();
        $no = 1;
        $data = '';
        foreach ($list as $k) {
            $data .= '<tr>';
            $data .= '<td><a class="btn btn-danger btn-sm" title="Delete" href="javascript:void(0)"  onclick="var x = confirm(\'Hapus?\'); if (x) {hapus(\'' . $k->id . '\')}else{return false}"> <i class="fa fa-trash"></i> <span></span></a>
				<a class="btn btn-success btn-sm" title="Edit" href="javascript:void(0);" onclick="edit(\'' . $k->id . '\')"> <i class="fa fa-edit"></i> <span></span></a></td>';
            $data .= '<td>' . $no . '</td>';
            $data .= '<td><img style="max-width: 75px;max-height: 75px;" src="'.asset($k->image == '' ? 'assets/user/no_photo.png' : $k->image).'" /></td>';
            $data .= '<td>' . $k->name . '</td>';
            $data .= '<td>' . $k->email . '</td>';
            $data .= '<td>' . $k->password . '</td>';
            $data .= '<td>' . $k->level . '</td>';
            $data .= '</tr>';
            $no++;
        }
        echo $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $a)
    {

        $post = $a->all();
        $post["password"] = bcrypt($post["password"]);
        $post["remember_token"] = Str::random(60);

        if (isset($_FILES['image']['name'])) {
            $name = 'assets/user/' . rand(0, 999999) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['image']['tmp_name'], $name);
            $post['image'] = $name;
        } else {
            if ($a->id == '') {
                $post['image'] = 'assets/user/no_photo.png';
            }
        }
        if ($a->id == '') {

            $sv = UserModel::create($post);

            $result = array();
            if ($sv) {
                $result["status"] = true;
                $result["message"] = "Berhasil";
            } else {
                $result["status"] = false;
                $result["message"] = "Gagal";
            }
            echo json_encode($result);
        } else {
            if ($a->password == '') {
                unset($post['password']);
            }
            unset($post['_token']);
            $sv = UserModel::where('id', $a->id)->update($post);
            $result = array();
            if ($sv) {
                $result["status"] = true;
                $result["message"] = "Berhasil";
            } else {
                $result["status"] = false;
                $result["message"] = "Gagal";
            }
            echo json_encode($result);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $r)
    {
        $get = UserModel::where('id', $r->id)->get();
        $get["name"] = $get[0]->name;
        $get["email"] = $get[0]->email;
        $get["level"] = $get[0]->level;
        $get["id"] = $get[0]->id;
        $get["image"] = $get[0]->image;
        echo json_encode($get);
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
    public function destroy(Request $r)
    {

        $sv = UserModel::destroy($r["id"]);
        $result = array();
        if ($sv) {
            $result["status"] = true;
            $result["message"] = "Berhasil Dihapus";
        } else {
            $result["status"] = false;
            $result["message"] = "Gagal Dihapus";
        }
        echo json_encode($result);

    }
}