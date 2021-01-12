<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

use App\Model\Attachment;

class AttachmentController extends Controller
{
    public function delete(Request $request, $id)
    {
        $attachment = Attachment::find($id);

        $attachment->delete();

        Storage::disk('public')->delete($attachment->path .'/'. $attachment->filename);

        $FileSystem = new Filesystem();
		$directory = 'storage/' . $attachment->path;

		if ($FileSystem->exists($directory)) {
		  $files = $FileSystem->files($directory);
	
		  if (empty($files)) {
		    $FileSystem->deleteDirectory($directory);
		  }
		}
    }
}
