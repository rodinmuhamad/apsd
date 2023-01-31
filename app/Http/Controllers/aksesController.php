<?php

namespace App\Http\Controllers;

use App\AksesModel;
use App\Http\Controllers\Controller;
use App\UserModel;
use Illuminate\Http\Request;

class aksesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list = UserModel::where('level', 'admin')->get();
        $akses = array(
            array(
                "url" => "produk","name"=>"Produk"
            ),
            array(
                "url" => "order","name"=>"Order"
            ),
            array(
                "url" => "user","name"=>"user"
            ),
            array(
                "url" => "akses","name"=>"Akses"
            )
        );
        return view('user.akses', ['title' => 'User Access','akses'=>$akses,'user'=>$list]);
    }

    public function table()
    {

        $list = AksesModel::select("a.user_id","a.id","b.name","b.email","a.akses")->from('akses as a')->join('users as b','a.user_id','=','b.id')->get();
        $no = 1;
        $data = '';
        foreach ($list as $k) {
            $data .= '<tr>';
            $data .= '<td><a class="btn btn-danger btn-sm" title="Delete" href="javascript:void(0)"  onclick="var x = confirm(\'Hapus?\'); if (x) {hapus(\'' . $k->id . '\')}else{return false}"> <i class="fa fa-trash"></i> <span></span></a>
				<a class="btn btn-success btn-sm" title="Edit" href="javascript:void(0);" onclick="edit(\'' . $k->id . '\')"> <i class="fa fa-edit"></i> <span></span></a></td>';
            $data .= '<td>' . $no . '</td>';
            $data .= '<td>' . $k->name . '</td>';
            $data .= '<td>' . $k->email . '</td>';
            $data .= '<td>' . $k->akses . '</td>';
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
        
        $get = AksesModel::where(array("user_id"=>$a->user_id,"akses"=>$a->akses))->get();
        if (count($get)) {
            $result["status"] = false;
            $result["message"] = "Data Sudah Ada";
            echo json_encode($result);
            exit;
        }

        if ($a->id == '') {

            $sv = AksesModel::create($post);

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
            unset($post['_token']);
            $sv = AksesModel::where('id', $a->id)->update($post);
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
        $get = AksesModel::where('id', $r->id)->get();
        $get["akses"] = $get[0]->akses;
        $get["id"] = $get[0]->id;
        $get["user_id"] = $get[0]->user_id;
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

        $sv = AksesModel::destroy($r["id"]);
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
