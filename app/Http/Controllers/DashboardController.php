<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $allClients = Client::count();
       
        $activeDeals = Deal::where('status', '!=', 'Won')
    ->where('status', '!=', 'Lost')
    ->count();

    $totalDealValue = Deal::sum('amount');
    $tasksToDo = Task::where('status', 'To Do')->count();
    $tasksInProgress = Task::where('status', 'In Progress')->count();
    $tasksCompleted = Task::where('status', 'Completed')->count();

     return view('dashboard', 
     ['allClients' => $allClients,
      'activeDeals' => $activeDeals,
      'totalDealValue'=> $totalDealValue ,
      'tasksToDo'=> $tasksToDo,
      'tasksInProgress'=> $tasksInProgress,
      'tasksCompleted' => $tasksCompleted

     ]);

    }
}