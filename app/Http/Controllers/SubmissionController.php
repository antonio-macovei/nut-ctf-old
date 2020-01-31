<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;
use App\Models\Challenge;
use App\Models\User;
use App\Models\Team;

class SubmissionController extends Controller
{

    /**
     * Check flag submission.
     *
     * @param  Request  $request
     * @return Response
     */
    public function submitFlag(Request $request)
    {
        if (!Auth::check()) {
            $error = \Illuminate\Validation\ValidationException::withMessages([ 'flag' => ['You must be logged in to submit a flag!']]);
            throw $error;
        }
        $validatedData = $request->validate([
            'challenge_id' => ['required', 'numeric', 'exists:challenges,id'],
            'flag' => ['required', 'min:3', 'max:37']
        ], [
            'challenge_id.required' => 'There was an error submitting your flag.',
            'challenge_id.numeric' => 'There was an error submitting your flag.',
            'challenge_id.exists' => 'There was an error submitting your flag.'
        ]);
        $user = Auth::user();
        $challenge_id = $request->input('challenge_id');
        $flag = $request->input('flag');
        $challenge = Challenge::find($challenge_id);
        $alreadySubmitted = Submission::where('challenge_id', $challenge->id)
                                                            ->where('team_id', $user->team->id)
                                                            ->where('status', 1)
                                                            ->count();
        if ($alreadySubmitted) {
            $error = \Illuminate\Validation\ValidationException::withMessages([ 'flag' => ['You have already submitted this flag!']]);
            throw $error;
        }

        $status = (strcmp($challenge->flag, $flag) === 0);
        $submission = new Submission;
        $submission->user_id = $user->id;
        $submission->team_id = $user->team->id;
        $submission->challenge_id = $challenge->id;
        $submission->submitted_at = now();
        $submission->status = $status;
        $submission->flag = $flag;
        $submission->save();

        if (!$status) {
            $error = \Illuminate\Validation\ValidationException::withMessages([ 'flag' => ['Ops! That\'s not the right flag. Keep looking!']]);
            throw $error;
        }
        $response['status'] = "success";
        $response['message'] = "You found the correct flag! Congratulations!";
        return response()->json($response);
    }

    /**
     * Return submissions for the given challenge.
     *
     * @param  int  $id
     * @return JSON
     */
    function getSubmissions($id) {
        $challenge = Challenge::find($id);
        if ($challenge == null) {
            $error['message'] = 'Challenge not found';
            return response()->json($error);
        }
        $submissions = Submission::where('challenge_id', $challenge->id)->orderBy('submitted_at', 'desc')->get();
        $response = $submissions;
        return response()->json($response);
    }
}
