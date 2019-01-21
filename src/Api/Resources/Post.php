<?php

namespace Jdsf\MiniForum\Api\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Post extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'images'=>$this->images,
            'content'=>$this->content,
            'comments'=>Comment::collection($this->comments),
            'post_owner'=>$this->user,
            'zan_user_ids'=>$this->zan_users->map(function($user){
                return $user->id;
            }),
            'zan_user_names'=>$this->zan_users->map(function($user){
                return $user->name;
            }),

            'created_at'=>time_since($this->created_at),
        ];
    }
}
