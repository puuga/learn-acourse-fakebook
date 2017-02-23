<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Utils\FileUtil;

use App\User;
use App\File;

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

  public function showPicture($id) {
    $fileModel = File::where('user_id', Auth::id())
      ->latest()
      ->first();
    $content = Storage::get($fileModel->full_path);

    return response($content)->header('Content-Type', $fileModel->mime);
  }

  public function myProfile() {
    return $this->show(Auth::id());
  }

  public function uploadProfilePicture(Request $request) {
    $file = $request->file('profile_picture');

    $fileUtil = new FileUtil;

    $profilePicture = $fileUtil->saveProfilePicture($file, Auth::id());

    return $profilePicture;
  }
}
