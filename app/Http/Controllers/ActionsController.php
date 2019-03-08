<?php 

namespace App\Http\Controllers;

/**
 * Get the models
 */
use App\Post;
use App\Role;
use App\User;
use App\Comment;

use App\Http\Controllers\Controller;


class ActionsController extends Controller {


	/**
	 * Create new user with role 3 = USER
	 * @return [type] [description]
	 */
	public function createUser()
	{
		$UserRole = 3;

		/**
		 * 
		 * Add new User Details
		 */
		$user = new User;
		$user->name = 'name-'. base64_encode(random_bytes(5));
		$user->email = base64_encode(random_bytes(5)).'@gmail.com';
		$user->password = base64_encode(random_bytes(3));
		$user->save();

		/**
		 * Attach a role as 'User' for newly created 'user details'
		 * @var [type]
		 */
		$role = Role::find($UserRole);
		$role->users()->attach($user->id);
	}

	/**
	 * Create new post using name in users table
	 * 
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public function createPostByUser($name)
	{
		$user = User::where('name' , '=', $name)->first();
		$post = new Post;

		$post->title = $this->randomString(5);
		$post->slug	 = $this->randomString(5);
		$post->status = $this->randomString(5); 
		$post->user_id = $user->id;
		$post->category_id = mt_rand(0, 9);
		$post->view = mt_rand(0, 9);
		$post->save();
	}

	/**
	 * Create single comment from a post
	 * 
	 * @return [type] [description]
	 */
	public  function createComment()
	{
		$postId = 1;

		$post = Post::find($postId);
		$comment = new Comment;
		$comment->website = "www.". base64_encode(random_bytes(5)).'.com';
		$comment->email =  base64_encode(random_bytes(5)).'@gmail.com';
		$comment->text =   base64_encode(random_bytes(10));
		$post = $post->comments()->save($comment);
	}

	/**
	 * Create comment(s) from a post
	 * 
	 * @return [type] [description]
	 */
	public  function createComments()
	{
		$postId = 2;

		$post = Post::find($postId);
		$comment1 = new Comment;
		$comment1->website = "www.". base64_encode(random_bytes(5)).'.com';
		$comment1->email =  base64_encode(random_bytes(5)).'@gmail.com';
		$comment1->text =   base64_encode(random_bytes(10));

		$comment2 = new Comment;
		$comment2->website = "www.". base64_encode(random_bytes(5)).'.com';
		$comment2->email =  base64_encode(random_bytes(5)).'@yahoo.com';
		$comment2->text =   base64_encode(random_bytes(10));
		
		$post = $post->comments()->saveMany([$comment1, $comment2]);
	}




	/*
	 * Create a random string
	 * @author	XEWeb <>
	 * @param $length the length of the string to create
	 * @return $str the string
	 */
	private function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
}
