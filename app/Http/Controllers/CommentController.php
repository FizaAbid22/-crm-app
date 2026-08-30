<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store (Request $request, string $id)
    {

        $current_user = auth()->id();
        $deal_id = $id;
        $validate = $request->validate([
            'body' =>'required'
        ]);
       Comment::create([
        'deal_id' => $deal_id,
        'user_id' => $current_user,
        'body' => $validate['body']

       ]);
       return redirect('/deals/' . $deal_id);
    }
    }

