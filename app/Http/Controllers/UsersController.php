<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Post;
use App\Comment;
use App\Tag;
use App\Rating;
use Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Validator;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{


	
		$user_id= Auth::user()->id;
		$user = User::find($user_id);
		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$user_id = Auth::user()->id;
		$user_name = Input::get('name');
		$user_email = Input::get('email');
		$user_password = bcrypt(Input::get('password'));

        User::findOrFail($user_id)
        		->update();
           // ->update(['name'=>$user_name, 'email'=>$user_email,'password'=>$user_password]);

          return redirect('users/{$user_id}/edit');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	/**
	 * Update the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateUser(){
		$user_id = Auth::user()->id;

		$user_name = trim(strip_tags(Input::get("name")));
		$user_email = trim(strip_tags(Input::get("email")));
		$user_password = bcrypt(trim(strip_tags(Input::get("password"))));

		$file = Input::file("thumbnail");

		if(($user_name == "") || ($user_email == "") || ($user_password == "")){
			flash()->error('Ne visi laukai užpildyti');
			return redirect("/users/".$user_id."/edit");
		}

		$user = User::find($user_id);

		if ($file) {
	        $destinationPath = '/images/';
	        $image = strtolower(date('Y_m_d_H_i_s') . '.' . $file->getClientOriginalExtension());
	        $newupload = $file->move(public_path().$destinationPath, $image);

	        $user->avatar = $image;
		}

		$user->name =  $user_name;
		$user->email =  $user_email;
		$user->password = $user_password;
		$user->update();

		flash()->success('Vartotojas pakeistas!'); 
		return redirect("/users/".$user_id."/edit");
	}

	public function admin(){

		$admin = User::admin()->get();

		return view('users.admin', compact('admin'));
		

		//return $user_admin;
	}




}
