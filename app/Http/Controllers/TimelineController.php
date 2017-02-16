<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Timeline;

class TimelineController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function store(Request $request) {
    // validate request
    $this->validate($request, [
        'content' => 'required|max:255',
    ]);

    $timeline = new Timeline;
    $timeline->user_id = Auth::id();
    $timeline->content = $request->content;

    $timeline->save();

    return back();
  }
}
