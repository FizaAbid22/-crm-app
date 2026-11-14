<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\TimeLog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Activity;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    if (auth()->user()->role == 'admin') {

        $users = User::all();
        $deals = Deal::all();
        $timeLogs = [];

        if ($request->user_id || $request->deal_id || $request->start_date) {
            $timeLogs = TimeLog::query()

            //   ->with('user', 'deal')
                ->when($request->user_id, function ($query) use ($request) {
                    $query->where('user_id', $request->user_id);
                })
                ->when($request->deal_id, function ($query) use ($request) {
                    $query->where('deal_id', $request->deal_id);
                })
                ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('date', [$request->start_date, $request->end_date]);
                })
                ->get();
        }

        return view('timelogs.index', [
            'users' => $users,
            'deals' => $deals,
            'timeLogs' => $timeLogs,
        ]);

    } else {

        $myLogs = auth()->user()->timeLogs()->with('deal')->latest('date')->get();
    return view('timelogs.team-index', ['myLogs' => $myLogs]);

    }
}


    public function export(Request $request)
    {

    $user = User::all();
    $deal = Deal::all();
    $timeLogs = [];

    if($request->user_id || $request->deal_id || $request->start_date )
        {
            $timeLogs = TimeLog::query()
            ->when($request->user_id, function($query) use ($request){
                $query->where('user_id', $request->user_id);
            })
            ->when($request->deal_id , function($query) use ($request) {
              $query->where('deal_id', $request->deal_id); 
            })
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('date', [$request->start_date, $request->end_date]);
                })
                ->get();
            return response()->streamDownload(function () use ($timeLogs) {
                $handle = fopen('php://output', 'w');

                fputcsv($handle, ['Employee', 'Project', 'Date', 'Start', 'End', 'Hours', 'Notes']);

                foreach ($timeLogs as $log) {
                        $hours = round(\Carbon\Carbon::parse($log->start_time)->diffInMinutes(\Carbon\Carbon::parse($log->end_time)) / 60, 2);

                        fputcsv($handle, [
                            $log->user->name,
                            $log->deal->title,
                            \Carbon\Carbon::parse($log->date)->format('Y-m-d'),
                            $log->start_time,
                            $log->end_time,
                            $hours,
                            $log->notes,
                        ]);
                    }

                    fclose($handle);
                }, 'time-logs.csv');

                        }

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deals = auth()->user()->deals;
        return view('timelogs.create', ['deals' => $deals]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validate = $request->validate([
        'date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'notes' => 'required',
        'deal_id' => 'required'
    ]);
    $validate['user_id'] = auth()->id();

    $timeLog = TimeLog::create($validate);

    Activity::create([
        'user_id' => auth()->id(),
        'deal_id' => $timeLog->deal_id,
        'description' => 'Logged time from ' . $timeLog->start_time . ' to ' . $timeLog->end_time,
    ]);

    return redirect('/time-logs');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timeLog = TimeLog::findOrfail($id); 
        return view('timelogs.show',['timeLog'=> $timeLog]);
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      

    $timeLog = TimeLog::findOrFail($id);

    $deals = auth()->user()->deals;

    return view('timelogs.edit', [
        'timeLog' => $timeLog,
        'deals' => $deals
    ]);

       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
