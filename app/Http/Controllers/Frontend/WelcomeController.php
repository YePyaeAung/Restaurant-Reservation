<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function index()
    {
        $specials = Cache::rememberForever('specials', function () {
            // return DB::table('users')->get();
            return Category::with('menus')->where('name', 'specials')->first();
        });
        // $specials = Category::with('menus')->where('name', 'specials')->first();
        return view('welcome', compact('specials'));
    }
    public function thankyou()
    {
        return view('thankyou');
    }
}
