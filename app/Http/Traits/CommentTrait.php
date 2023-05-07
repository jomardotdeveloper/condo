<?php

namespace App\Http\Traits;

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

trait CommentTrait {
    public function createComment($user_id, $model, $record, $message, $files = []) {
        $comment = Comment::create([
            'user_id' => $user_id,
            'model' => $model,
            'record' => $record,
            'message' => $message,
        ]);

        foreach ($files as $file) {
            $path = $this->uploadAttachment($file, 'comment_attachments');
            $comment->commentAttachments()->create([
                'file_src' => $path
            ]);
        }

        return $comment;
    }

    public function getAllComments($model, $modelId) {
        return Comment::where('model', $model)->where('record', $modelId)->get();
    }

    private function uploadAttachment ($file, $file_path) {
        $path = Storage::putFile("public/" . $file_path, $file);
        $path = Storage::url($path);
        return $path;
    } 
}