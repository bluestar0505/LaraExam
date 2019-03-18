<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Request;

class UploadsManagerController extends Controller
{

    use FileUploadTrait;


    public function index()
    {

        $this->checkUploadsFolderExists();

        $files = $this->getFilesInUploadFolder();


        return view('admin.uploadsmanager.index', compact('files'));
    }


    public function submit(Request $request)
    {

        $uploads = $this->uploadFiles($request);

        $data = [];
        foreach ($uploads as $upload) {
            $data[] = view('admin.uploadsmanager.parts.file', ['file' => $upload])->render();
        }

        return [
            'uploads' => $data,
        ];
    }

    public function delete(Request $request)
    {

        $this->validate($request, [
            'url' => 'required'
        ]);

        $filename = basename($request->get('url'));
        $file = public_path('uploads/' . $filename);

        if (File::exists($file)) {
            $check = File::delete($file);

            return [
                'ok' => $check,
            ];
        }


        return [
            'not' => 'not found',
        ];

    }


    private function checkUploadsFolderExists()
    {

        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0777);
        }

    }

    private function getFilesInUploadFolder()
    {

        $dir = public_path('uploads');
        $files = File::allFiles($dir);

        $data = [];
        foreach ($files as $file) {
            $data[] = basename($file);
        }
        return $data;
    }


}