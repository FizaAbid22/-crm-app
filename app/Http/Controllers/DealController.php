<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DealWon;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::all();
        return view('deals.index',['deals'=>$deals]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $users = User::all();
        return view('deals.create', ['clients' => $clients, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'status'=> 'required',
            'amount' => 'required',
            'client_id' => 'required|exists:clients,id',
            'due_date' => 'required|date',
            'start_date' => 'required|date',

        ]);

        $deals = Deal::create($validate);
        $deals->users()->attach($request->users ?? []);

        return redirect('/deals');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deals = Deal::findOrfail($id);
        $users = User::all();
        return view('deals.show', ['deals' => $deals, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
            $deal = Deal::findOrFail($id);
            $clients = Client::all();
            $users =User:: all();

            return view('deals.edit', [
                'deal' => $deal,
                'clients' => $clients,
                'users'=> $users
            ]);
        }
            /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required',
            'status'=> 'required',
            'amount' => 'required',
            'client_id' => 'required|exists:clients,id',
            'due_date' => 'required|date',
            'start_date' => 'required|date',
        ]);
        $deal = Deal::findOrFail($id);
        $deal->update($validate);
        if($deal->status == 'Won')
            {
                Mail::to('fizaabid2211@gmail.com')->queue(new DealWon($deal));
            }
        $deal->users()->sync($request->users ?? []);
        return redirect('/deals');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        $deal = Deal::findOrFail($id);
        $this->authorize('delete', $deal);
        $deal->users()->detach();
        $deal->delete();
        return redirect('/deals');
    }
}
