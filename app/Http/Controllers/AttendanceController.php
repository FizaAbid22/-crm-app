<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
    $user = auth()->user();
    if($user->role == 'admin')
        {
            $attendances = Attendance::with('user')->latest('check_in')->get();
            $openSession = null;
        }
        else{
              $attendances = Attendance::where('user_id',$user->id)->latest('check_in')->get();
              $openSession = Attendance:: where('user_id',$user->id)->whereNull('check_out')->first();


        }
        return view('attendance.index',compact('attendances','openSession'));

    }

      public function checkIn()
    {
        if(auth()->user()->role == 'admin')
            {
                abort(403);

            }
            $open = Attendance::where('user_id', auth()->user()->id)
            ->whereNull('check_out')
            ->first();
            if($open)
            {
            
             return redirect('/attendance')->with('error','You are already checked in.');
            }
            Attendance::create([
                'user_id' => auth()->user()->id,
                'check_in' =>now(),
            ]);
             return redirect('/attendance')->with('success', 'Checked in successfully.');
 
    }

      public function checkOut()
    {
        $open = Attendance::where("user_id", auth()->user()->id)->whereNull('check_out')->first();

        if(!$open)
            {
                 return redirect('/attendance')->with('error','You arenot check in.');

            }
        $open->update(['check_out' => now()]);

        return redirect('/attendance')->with('success', 'Checked out successfully.');
        
    }
}
