<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Reaction, PostImage};
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function store(Request $request)
    {

dd($request);

        $request->validate([
            'post_id' => 'required|integer|exists:post_images,id',
            'type' => 'required|string',
        ]);

        $userId = Auth::id();

        $postImage = PostImage::findOrFail($request->post_id);

        $existing = Reaction::where('post_image_id', $postImage->id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            if ($existing->type === $request->type) {
                $existing->delete();
            } else {
                $existing->update([
                    'type' => $request->type,
                ]);
            }
        } else {
            Reaction::create([
                'post_image_id' => $postImage->id,
                'user_id' => $userId,
                'type' => $request->type,
            ]);
        }

        return back();
    }
}
