<?php

namespace Jdsf\MiniForum\Api\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function respond($data = null, $err_code = 0, $err_msg = 'ok') {
		$ret = [
			'err_code' => $err_code,
			'err_msg' => $err_msg,
			'data' => $data,
		];
		return response()->json($ret);
	}

	public function respondWithError($err_msg = 'fail',$err_code = 1) {
		$this->respond(null, $err_code, $err_msg);
	}

}
