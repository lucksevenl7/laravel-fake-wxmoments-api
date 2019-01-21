<?php

namespace Jdsf\MiniForum\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model {
	protected $visible = ['id','name','avatar'];
}
