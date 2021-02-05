<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

use App\Model\Attachment;

use Auth;

class AttachmentController extends Controller
{
    public function delete(Request $request, $id)
    {
        $attachment = Attachment::find($id);

        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');

        Storage::disk($FILESYSTEM_DRIVER)->delete('client' . Auth::user()->client_id .'/'. $attachment->path .'/'. $attachment->filename);

  		if ($FILESYSTEM_DRIVER == "public") {
  			$FileSystem = new Filesystem();

            $directory = 'storage/'. $attachment->path;
        
            if ($FileSystem->exists($directory)) {
				$files = $FileSystem->files($directory);

				if (empty($files)) {
					$FileSystem->deleteDirectory($directory);
				}
			}
        }
		

		if ($FILESYSTEM_DRIVER == "spaces") {
			if ( in_array( 'client' . Auth::user()->client_id .'/'. $attachment->path, Storage::disk($FILESYSTEM_DRIVER)->directories('client' . Auth::user()->client_id) ) ) {
				
				if ( empty( Storage::disk($FILESYSTEM_DRIVER)->files('client' . Auth::user()->client_id .'/'. $attachment->path) ) ) {

					Storage::disk($FILESYSTEM_DRIVER)->deleteDirectory('client' . Auth::user()->client_id .'/'. $attachment->path);
				}
			}
		}

		$attachment->delete();
    }
}
