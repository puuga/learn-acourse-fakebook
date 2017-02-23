<?php

namespace App\Utils;

use App\File as FileModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileUtil {
  public function saveFile($file, $user_id) {
    $disk = 'user';
    return $this->save($file, $disk, $user_id);
  }

  public function saveProfilePicture($file, $user_id) {
    $disk = 'profile';
    return $this->save($file, $disk, $user_id);
  }

  private function save($file, $disk, $user_id) {
    $extension = $file->getClientOriginalExtension();
    $filename = $user_id.'-'.uniqid().'.'.$extension;

    Storage::disk($disk)
      ->put($user_id."/".$filename,  File::get($file));

    if ($disk === 'user') {
      $path = "user/".$user_id."/".$filename;
    } elseif ($disk === 'profile') {
      $path = "profile/".$user_id."/".$filename;
    }


    $fileModel = new FileModel;
    $fileModel->user_id = $user_id;
    $fileModel->file_name = $filename;
    $fileModel->file_extension = $extension;
    $fileModel->mime = $file->getClientMimeType();
    $fileModel->original_filename = $file->getClientOriginalName();
    $fileModel->location = $disk;
    $fileModel->full_path = $path;

    $fileModel->save();

    return $fileModel;
  }
}
