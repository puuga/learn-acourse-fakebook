<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class ProfileController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function show($id) {
    try {
      $user = User::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return view('profile.not_found');
    }

    $timelines = $user->timelines()->orderBy('created_at', 'desc')->get();
    
    return view('profile.show', [
      'user' => $user,
      'timelines' => $timelines,
    ]);
  }

  public function myProfile() {
    return $this->show(Auth::id());
  }
}
