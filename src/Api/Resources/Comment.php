<?php

namespace Jdsf\MiniForum\Api\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Comment extends Resource
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
            'comment_user'=>$this->comment_user,
            'content'=>$this->content,
            'parent_comment_user'=>optional($this->parent)->comment_user,
        ];
    }
}
