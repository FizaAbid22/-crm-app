<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $user = Auth::user();

    if ($user->role == 'admin') {
        $leaves = Leave::all();
    } else {
        $leaves = Leave::where('user_id', $user->id)->get();
    }

    return view('leaves.index', ['leaves' => $leaves]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {
        $validated = $request->validated();
        
       Leave::create([
            'user_id'    => Auth::user()->id,
            'start_date' => $validated['start_date'],
            'end_date'   => $validated['end_date'],
            'reason'     => $validated['reason'],
            'status'     => 'pending',
        ]);

        return redirect('/leave');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leave = Leave::findOrfail($id);

        return view('leaves.show',['leave'=>$leave]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leave = Leave::findOrfail($id);

        return view('leaves.edit',['leave'=>$leave]);
    }

    /**
     * Update the specified resource in storage.
        */
    public function update(UpdateLeaveRequest $request, string $id)
        {
          $validated = $request->validated();

        $leave = Leave::findOrFail($id);

        if ($leave->user_id !== auth()->id() || $leave->status !== 'pending') {
            abort(403);
        }

        $leave->update($validated);

        return redirect('/leave');
    }
public function updateStatus(Request $request, string $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,cancelled',
        ]);

        $leave = Leave::findOrFail($id);

        if ($leave->status !== 'pending') {
            abort(403);
        }

        $leave->update($validated);

        return redirect('/leave');
    }
        /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
    {
          $leave = Leave::findOrFail($id);

        if ($leave->user_id !== auth()->id() || $leave->status !== 'pending') {
            abort(403);
        }

        $leave->delete();

        return redirect('/leave');
    }
}
