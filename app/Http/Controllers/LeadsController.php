<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allLeads = Lead::all();
        return view('leads.index',['allLeads'=> $allLeads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allLeads = Lead::all();
        return view('leads.create',['allLaeda'=> $allLeads]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


     $validate = $request->validate([
           'name'=> 'required',
            'email'=> 'required|email',
            'phone'=> 'required',
            'status'=> 'required',

        ]);
       

       $leads = Lead::create( $validate);
        return redirect('/leads');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrfail($id);
        return view('leads.show',['lead'=>$lead]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $lead = Lead::findOrfail($id);
            return view('leads.edit',['lead'=>$lead]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
       $validate = $request->validate([
           'name'=> 'required',
            'email'=> 'required|email',
            'phone'=> 'required',
            'status'=> 'required',

        ]);
       

       $leads = Lead::findOrfail( $id);
       $leads-> update( $validate);

        return redirect('/leads');
    }


    public function convert(string $id)
    {
        $lead = Lead::findOrfail($id);
       if (is_null($lead->client_id))
            {
                $client = Client::where('email', $lead->email)->first();
                if (!$client) {
                $client = Client::create([
                   
                'name' => $lead->name,
                'email' => $lead->email,
                'phone' => $lead->phone,
                ]);
                }
                $lead->client_id = $client->id;
                $lead->save();

              
            }
              return redirect('/leads')->with('success','Lead converted to client successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Lead::findOrFail($id);
        
       $lead->delete();
        return redirect('/leads');
    }
}
