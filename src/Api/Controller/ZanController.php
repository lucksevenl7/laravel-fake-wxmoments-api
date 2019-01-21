<?php

namespace Jdsf\MiniForum\Api\Controller;

use Illuminate\Http\Request;
use Jdsf\MiniForum\Models\Zan;

class ZanController extends BaseController
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
    	$zan = Zan::updateOrCreate([
    		'user_id'=>$request->get('user_id'),
    		'post_id'=>$request->get('post_id')
    	]);

    	return $this->respond($zan);
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
    
    public function cancelZan(Request $request)
    {
    	$zan = Zan::where('user_id',$request->get('user_id'))
    		->where('post_id',$request->get('post_id'))
    		->first();
    	if (!is_null($zan)) {
    		return $this->respond($zan->delete());
    	}else{
    		return $this->respondWithError('object is not found');
    	}
    	
    }
}
