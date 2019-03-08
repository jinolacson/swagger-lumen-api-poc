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


class DetailsController extends Controller {


	/**
	 * @SWG\Get(
	 *   path="/getUserRole",
	 *   summary="Get all users",
	 *   @SWG\Response(response=200, description="successful operation")
	 * )
	 *
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public  function getUserRole(){
		//return response()->json(User::find(1)->roles[1]->name);
		foreach (User::find(1)->roles as $key => $role) {
			return response()->json($role->name);
		}
	}

	/**
	 * @SWG\Get(
	 *   path="/getRoleUser",
	 *   summary="Get all role users",
	 *   @SWG\Response(response=200, description="successful operation")
	 * )
	 *
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public  function getRoleUser(){
		//return response()->json(Role::find(1)->users);
		foreach (Role::find(1)->users as $key => $users) {
			return response()->json($users->name);
		}
	}

	/**
	 * Display user single post
	 * @return [type] [description]
	 */
	public  function getUserPost()
	{
		$user = User::find(1);
		return response()->json(array(
			"title" => $user->post->title,
			"slug" => $user->post->slug,
			"status" => $user->post->status
		));
	}

	/**
	 * Get posts ->comment(s)
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
    public function getPostById($id)
    {
    	$post = Post::find($id);
		return response()->json($post->comments);
    }

    /**
     * Get comment's -> post
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public  function getCommentsById($id){
    	$comment = Comment::find($id);
		return response()->json($comment->post);
    }
}
