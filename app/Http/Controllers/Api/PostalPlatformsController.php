<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\PostalPlatform;

class PostalPlatformsController extends ApiController
{
    public function index()
    {
        return PostalPlatform::all();
    }
}
