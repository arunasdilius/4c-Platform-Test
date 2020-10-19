<?php

namespace App\Http\Controllers;

use App\Http\BaseResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * The Response object.
     *
     * @var BaseResponse
     */
    protected BaseResponse $response;

    /**
     * Bootstrap the controller.
     */
    public function __construct()
    {
        $this->response = new BaseResponse();
    }
}
