<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChallengeRequest;
use App\Models\Challenge;
use App\Models\Category;

class ChallengeController extends Controller
{
    /**
     * Display the challenges.
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

    /**
     * Manage challenges.
     *
     * @param  Request  $request
     * @return Response
     */
    public function manage()
    {
        $challenges = Challenge::all();
        $categories = Category::all();
        return view('admin.challenges', ['challenges' => $challenges, 'categories' => $categories]);
    }

    /**
     * Update challenge.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ChallengeRequest $request)
    {
        $validated = $request->validated();

        $id = $request->input('id');
        $challenge = Challenge::find($id);
        $challenge->name = $request->input('name');
        $challenge->description = $request->input('description');
        $challenge->points = $request->input('points');
        $challenge->category_id = $request->input('category');
        $challenge->availability = $request->input('availability');
        $challenge->save();
        return response()->json($challenge);
    }

    /**
     * Delete challenge.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $challenge = Challenge::find($response->input('id'));
        if ($challenge == null) {
            $error['message'] = "Challenge not found";
            return response()->json($error);
        }
        $challenge->delete();
        $response['message'] = "success";
        return response()->json($response);
    }
}
