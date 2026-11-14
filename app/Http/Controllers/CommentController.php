<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Http\Request;

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

       Activity::create([
        'user_id'=> auth()->id(),
        'deal_id'=>  $deal_id,
        'description'=> 'Posted a comment'

       ]);
       return redirect('/deals/' . $deal_id);
    }
    }

