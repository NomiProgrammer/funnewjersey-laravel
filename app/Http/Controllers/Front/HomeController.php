<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannersAds;
use App\Models\Category;
use App\Models\User;
use App\Models\Locations;

class HomeController extends Controller
{
    public function index()
    {
        return 'Nomi';
    }
}
