<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\Category;

class ChallengeController extends Controller
{
     /**
     * Display the challenges
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $challenges[$category->id] = Challenge::where('category_id', $category->id)->get();
            $counts[$category->id] = Challenge::where('category_id', $category->id)->count();
        }
        return view('user.challenges', ['categories' => $categories, 'challenges' => $challenges, 'counts' => $counts]);
    }
}
