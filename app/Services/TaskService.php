<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskService
{

    public function uploadImage(Request $request):string|false
    {

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/task', $imageName);


        return $path ? str_replace("public/", "", $path) : false;
    }

    public function deleteUploadedImage(string $path): bool
    {

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

}
