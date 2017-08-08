<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    private $basePublicStoragePath = null;
    private $baseStorageRelativePath = null;
    private $avatarRelativePath = null;
    private $datePath = null;
    public function __construct()
    {
        $this -> basePublicStoragePath = storage_path('app/public');
        $this -> baseStorageRelativePath = '/files';
        $this -> avatarRelativePath = '/images/users/avatar';
        $this -> datePath = '/' . date('Ymd');
    }

    public function storeFile(Request $request)
    {
        $absolutePath = $this -> basePublicStoragePath . $this -> baseStorageRelativePath;
        $relativePath = $this -> baseStorageRelativePath;
        if ($request -> type === 'avatar') {
            $absolutePath .= $this -> avatarRelativePath . $this -> datePath;
            $relativePath .= $this -> avatarRelativePath . $this -> datePath;
        }

        if (!is_dir($absolutePath)) {
            mkdir($absolutePath);
        }

        $file = md5(uniqid()) . '.' . $request -> file ->extension();
        $request -> file('file') -> move($absolutePath, $file);
        return $relativePath . '/' . $file;
    }
}
