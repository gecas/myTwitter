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

class PostsController extends Controller {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */



	public function index()
	{
		//$test = Post::orderBy('created_at', 'DESC');
		//$posts = Post::orderBy('created_at', 'DESC')->get();
		//$u = User::all();
		/*$t1 = $ttt->find(9)->tags;
		$t2 = $ttt->find(5)->tags;
		$t3 = $ttt->find(8)->tags;*/
		//dd($ttt);
		//$tags = array();
		//$users = array();
		//$i = 0;
		//foreach ($posts as $t)
		//{
		//	$tags[$t->id] = $t->tags;
			//$data[$i]["tags"] = $t->tags()->get();
		   // var_dump($t->tags()->get());
		  //  $i++;
			//$users[$t->id] = $u[]
		//}
		//	dd($u);

		//var_dump($tags);
		//var_dump($posts);

		//dd("S");
		//$test = Post::all()->first();
		//$tg = $test->tags()->get();
		/*var_dump($t1);
		var_dump($t2);
		var_dump($t3);*/
		//dd($test);
        if(Auth::user()) {
            //$id = Auth::user()->id;
           // $users = DB::table('users')
               // ->where('isAdmin', '0',false)
               // ->get();
       // $notices = $this->user->posts()->get();
       //$posts = $this->user->posts()->latest()->get(); 	

       $posts = Post::orderBy('created_at', 'DESC')->get();
       $tags = Tag::lists('title','id');

       /*$ratings = DB::table('posts')
            ->select('posts.id', 'posts.likes', 'posts.dislikes')
           // ->join('ratings', 'posts.id', '=', 'ratings.post_id')
           // ->where('posts.id', '=','ratings.post_id')
            ->get();

       // dd($ratings);
 

      /* $rating = array();
       foreach ($posts as $v) {
       	$rating[] = Post::find($v->id)->ratings()->get();
       }
      // $rating = Post::orderBy('created_at', 'DESC')->ratings();
     
     dd($rating);*/
       

       //$latest = Post::latest()->first();
       //$comments = Comment::all();

        return view('posts.index',compact('posts','tags'));
       
       // $posts = Post::all();
       //  $posts = DB::table('posts')
       //  ->orderBy('posts.created_at', 'asc')
       // ->join('users', 'posts.user_id', '=', 'users.id')
       // ->join('comments', 'posts.id', '=', 'comments.post_id')
       // ->get()->latest();
        //$posts = Post::with('comments')->get();
		//return view('posts.index')->with('posts', $posts);
        }

        else{

	       return view('auth.login');
	   }

	}


	public function tags($tagId)
	{
        
            //$id = Auth::user()->id;
           // $users = DB::table('users')
               // ->where('isAdmin', '0',false)
               // ->get();
       // $notices = $this->user->posts()->get();
       //$posts = $this->user->posts()->latest()->get(); 	

		if(Auth::user()) {

		//$posts = new Post;

        $posts = DB::table('posts')
            ->select('posts.id', 'posts.title', 'posts.body', 'posts.user_id')
            ->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->where('post_tag.tag_id', '=',$tagId)
            ->get();

         //dd($posts);

       //$posts = Post::orderBy('created_at', 'DESC')->get();


      // $posts = Post::find($tagId);
       $tags = \App\Tag::lists('title','id');


       //$latest = Post::latest()->first();
       //$comments = Comment::all();

        return view('posts.tags',compact('posts','tags'));
       
       // $posts = Post::all();
       //  $posts = DB::table('posts')
       //  ->orderBy('posts.created_at', 'asc')
       // ->join('users', 'posts.user_id', '=', 'users.id')
       // ->join('comments', 'posts.id', '=', 'comments.post_id')
       // ->get()->latest();
        //$posts = Post::with('comments')->get();
		//return view('posts.index')->with('posts', $posts);
      }

        else{

	       return view('auth.login');
	   }

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(CreatePostRequest $request)

	{
		$tags = \App\Tag::lists('title');
		
		return view('posts.create', compact('tags','posts'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $posts = new Post;

        $posts->title= Input::get('title');
        $posts->body= Input::get('body');
        $posts->user_id = Auth::user()->id;

        $tagIds = Input::get('tags');

        if((Input::get('title') == "") || (Input::get('body') == "")){
			flash()->error('Ne visi laukai užpildyti');
			return Redirect::back()->withInput();
		}

        if(Input::hasFile('thumbnail')) {
            $file = Input::file('thumbnail');
            $name =  time() . '-' . $file->getClientOriginalName();
            // $file->move(public_path() . '/images/', 'myfile.jpg');
            /* return [
                 'path'=> $file->getRealPath(),
                 'size'=> $file->getSize(),
                 //'mime'=> $file->getMimeType(),
                 'name'=> $file->getClientOriginalName(),
                 'extension'=> $file->getClientOriginalExtension()
             ];*/

            $file =  $file -> move(public_path() . '/images/', $name);

            $posts->thumbnail = $name;
        }

        $posts->save();
        $posts->tags()->attach($tagIds);

        flash()->success('Įrašas sukurtas!');
        return redirect('posts/');
    }




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//$post = Post::findOrFail($id);
		//$comments = \App\Comment::where('post_id','=',$id)->get();

		$post = Post::find($id);
		$comments = $post->comments()->orderBy('created_at', 'DESC')->paginate(5);
		// $posts = Post::orderBy('created_at', 'DESC')->get();
		//$ratings = Rating::where('post_id',"=",$id)->get();
		$now = Carbon::now();

		return view('posts.show',compact('post','comments'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		//$edit_post_id= $id;
		//dd($id);
		//$posts = Post::first($edit_post_id)->get();
		//dd($post);
		$post = Post::where('id','=',$id)->first();

		//$post = $id;
		$posts = Post::orderBy('created_at', 'DESC')->get();

       	$tags = Tag::lists('title','id');
	
	
		//return view('posts.edit',compact('post','posts','tags'));
		return view('posts.edit',compact('posts','post','tags'));
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{




		$post_title = Input::get('title');
		$post_body = Input::get('body');	
		//dd($post_body);

        Post::findOrFail($id)
            ->update(['title'=>$post_title,'body'=>$post_body]);

    $id=Input::get('id');
    $rules= array(		'title'=>'required|regex:/(^[A-Za-z]+$)+/',
                        'body'=>'required|regex:/(^[A-Za-z]+$)+/',
                        );
    $data = Input::all();

    $validation = Validator::make($data,$rules);
    if ($validation->passes()){

        $file =Input::file('thumbnail');
        $destinationPath = 'images/';
        $image = value(function() use ($file){
        $filename = date('Y-m-d-H:i:s') . '.' . $file->getClientOriginalExtension();
        return strtolower($filename);
            });

        $newupload =Input::file('thumbnail')->move($destinationPath, $image);


        DB::table('posts')
                        ->where('id', $id)  
                                ->limit(1)  
                            ->update(array('title' => Input::get('title'), 'body' => Input::get('body'), 'thumbnail' => $newupload));


        $data=Post::first($id);
        /* return view('posts/')->compact('data',$data)
                                    ->withErrors($validation)
                                ->with('message', 'Successfully updated.');*/
        }

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::find($Postid)->delete();
        //flash('Your notice has been deleted!');
       // $post = Post::find($id);    
		//$user->forceDelete();

        //return redirect()->back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $id
	 */
	public function addLike($id)
	{
        $post = Post::find($id);
        $post->likes = $post->likes + 1;
		$post->save();

		return $post->likes;
    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  int  $id
	 */
	public function addDislike($id)
	{
        $post = Post::find($id);
        $post->dislikes = $post->dislikes + 1;
		$post->save();

		return $post->dislikes;
    }

    public function comments(){
    	return 'Comment';
    }

    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 */
	public function deletePost($id)
	{
		$post = Post::find($id);
		$post->comments()->delete();
		$post->delete();
	}

	   /**
	 * Update the specified resource from storage.
	 *
	 * @param  int  $id
	 */
	public function updatePost(){
		$post_id = Input::get("post_id");
		$post_title = trim(strip_tags(Input::get("title")));
		$post_body = trim(strip_tags(Input::get("body")));

		$post_tags = trim(strip_tags(Input::get('tags[]')));

		$file = Input::file("thumbnail");

		if(($post_title == "") || ($post_body == "")){
			flash()->error('Ne visi laukai užpildyti');
			return redirect("/posts/".$post_id."/edit");
		}

		$post = Post::find($post_id);


		if ($file) {
	        $destinationPath = '/images/';
	        $image = strtolower(date('Y_m_d_H_i_s') . '.' . $file->getClientOriginalExtension());
	        $newupload = $file->move(public_path().$destinationPath, $image);

	        $post->thumbnail = $image;
		}

		$post->title =  $post_title;
		$post->body =  $post_body;
		//$post->tags = $post_tags;
		$post->update();

		flash()->success('Įrašas pakeistas!'); 
		return redirect("/posts");
	}

	public function userPosts($id){

		
		$posts = Post::where('user_id','=',$id)->orderBy('created_at','desc')->get();
		$tags = Tag::lists('title','id');

		return view('posts.userPosts', compact('posts','tags'));
	}
	

	public function search(){
		$search = Input::get('search');

		//$tags = Tag::lists('title','id');

		$posts = Post::where('body', 'LIKE', '%'.$search.'%')
						 	->orWhere('title','LIKE','%'.$search.'%')
						 		->get(); 
			//dd($posts);

		return view('posts.search', compact('posts'));
		

	}

}
