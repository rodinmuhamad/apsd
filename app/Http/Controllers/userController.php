<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user',['title'=>'User Master']);
    }
    
	public function table(){
        
			$list = UserModel::all();
			$no=1; 
			$data = '';
			foreach ($list as $k) {
				$data .= '<tr>';
				$data .= '<td><a class="btn btn-danger btn-delete" title="Delete" href="javascript:void(0)"  onclick="var x = confirm(\'Hapus?\'); if (x) {hapus(\''.$k->id .'\')}else{return false}"><i class="loading-icon-delete fa fa-spinner fa-spin hide"></i> <i class="icon-close"></i> <span></span></a>
				<a class="btn btn-success btn-edit" title="Edit" href="javascript:void(0);" onclick="edit(\''.$k->id .'\')"><i class="loading-icon-edit fa fa-spinner fa-spin hide"></i> <i class="icon-pencil"></i> <span></span></a></td>';
					$data .= '<td>'.$no.'</td>';
					$data .= '<td>'.$k->name.'</td>';
					$data .= '<td>'.$k->email.'</td>';
					$data .= '<td>'.$k->password.'</td>';
					$data .= '<td>'.$k->level.'</td>';
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
    public function store(Request $request)
    {
        //
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