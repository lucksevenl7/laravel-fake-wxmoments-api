<?php

namespace Jdsf\MiniForum\Api\Controller;

use Illuminate\Http\Request;
use Jdsf\MiniForum\Models\Comment;
use Jdsf\MiniForum\Api\Resources\Comment as CommentResource;

class CommentController extends BaseController
{
	public function index()
	{
		# code...
	}
	
	public function create()
	{
		# code...
	}
	
	public function store(Request $request)
	{
		$post = Comment::create($request->all());
		return $this->respond(new CommentResource($post));
	}
	
	public function show($id)
	{
		# code...
	}
	
	public function edit($id)
	{
		# code...
	}
	public function update($id,Request $request)
	{
		# code...
	}
	
	public function destroy($id)
	{
		# code...
	}
}
