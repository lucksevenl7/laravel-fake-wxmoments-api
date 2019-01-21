<?php

namespace Jdsf\MiniForum\Api\Controller;

use Illuminate\Http\Request;
use Jdsf\MiniForum\Models\Post;
use Jdsf\MiniForum\Api\Resources\Post as PostResource;
use Jdsf\MiniForum\Models\Zan;

class PostController extends BaseController
{
	public function index()
	{
		$posts = Post::with(['comments','user','comments.comment_user','comments.parent','comments.parent.comment_user','zan_users'])
			->orderBy('created_at','desc')
			->paginate();
		return PostResource::collection($posts);
	}
	
	
	public function store(Request $request)
	{
		$post = Post::create($request->all());
		return $this->respond(new PostResource($post));
	}
	
	public function show($id)
	{
		$post = Post::with(['comments','user','comments.comment_user','comments.parent','comments.parent.comment_user','zan_users'])
			->findOrFail($id);
		return $this->respond(new PostResource($post));
	}
	
	
	public function destroy($id,Request $request)
	{
		$post = Post::findOrFail($id);
		\Log::info($request->all());
		if ($request->user()->id != $post->user_id) {
			return $this->respondWithError('403');
		}else{
			\DB::beginTransaction();
			try {
				$post->delete();
				$post->comments()->delete();
				Zan::where('post_id',$id)
					->delete();
				\DB::commit();
				return $this->respond();
			} catch (\Exception $e) {
				\DB::rollback();
				return $this->respondWithError('delete post fail');
			}
		}
	}
}
