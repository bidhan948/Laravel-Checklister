<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function store()
    {
        $task = new Task;
        $task->id = 0;
        $task->exists = true;
        $image = $task->addMediaFromRequest('upload')->toMediaCollection('images');
        $image_name = $image->getUrl('thumb');
        $final_image = Str::replaceFirst('http://checklister.test/','http://127.0.0.1:8000/',$image_name); 
        return response()->json([
            'url'=>$final_image
        ]);
    }
}