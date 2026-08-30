<?php

namespace App\Http\Controllers;

use App\Mail\TaskAssigned;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
 public function store(Request $request, $deal)
{
    $validate = $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'status' => 'nullable',
        'due_date' => 'nullable',
    ]);

    $validate['deal_id'] = $deal;

    $task = Task::create($validate);

    $task->users()->attach($request->users ?? []);
    $assignedUsers = User::whereIn('id',$request->users ?? [])->get(); 
        foreach ($assignedUsers as $user) {
            Mail::to($user->email)->queue(new TaskAssigned($task, $user));
        }

    return redirect('/deals/' . $deal);
}
}