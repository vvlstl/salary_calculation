<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Servises\Transaction\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {

        $this->service = $service;
    }

}
