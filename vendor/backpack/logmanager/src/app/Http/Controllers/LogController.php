<?php

namespace Backpack\LogManager\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Storage;

class LogController extends Controller
{
    /**
     * Lists all log files.
     */
    public function index()
    {
        $disk = Storage::disk('storage');
        $files = $disk->files('logs');
        $this->data['logs'] = [];

        // make an array of log files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.log' && $disk->exists($f)) {
                $this->data['logs'][] = [
                                            'file_path'     => $f,
                                            'file_name'     => str_replace('logs/', '', $f),
                                            'file_size'     => $disk->size($f),
                                            'last_modified' => $disk->lastModified($f),
                                            ];
            }
        }

        // reverse the logs, so the newest one would be on top
        $this->data['logs'] = array_reverse($this->data['logs']);
        $this->data['title'] = trans('backpack::logmanager.log_manager');

        return view('logmanager::logs', $this->data);
    }

    /**
     * Previews a log file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function preview($file_name)
    {
        $disk = Storage::disk('storage');

        if ($disk->exists('logs/'.$file_name)) {
            $this->data['log'] = [
                                    'file_path'     => 'logs/'.$file_name,
                                    'file_name'     => $file_name,
                                    'file_size'     => $disk->size('logs/'.$file_name),
                                    'last_modified' => $disk->lastModified('logs/'.$file_name),
                                    'content'       => $disk->get('logs/'.$file_name),
                                    ];
            $this->data['title'] = trans('backpack::logmanager.preview').' '.trans('backpack::logmanager.logs');

            return view('logmanager::log_item', $this->data);
        } else {
            abort(404, trans('backpack::logmanager.log_file_doesnt_exist'));
        }
    }

    /**
     * Downloads a log file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $disk = Storage::disk('storage');

        if ($disk->exists('logs/'.$file_name)) {
            return response()->download(storage_path('logs/'.$file_name));
        } else {
            abort(404, trans('backpack::logmanager.log_file_doesnt_exist'));
        }
    }

    /**
     * Deletes a log file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function delete($file_name)
    {
        $disk = Storage::disk('storage');

        if ($disk->exists('logs/'.$file_name)) {
            $disk->delete('logs/'.$file_name);

            return 'success';
        } else {
            abort(404, trans('backpack::logmanager.log_file_doesnt_exist'));
        }
    }
}
