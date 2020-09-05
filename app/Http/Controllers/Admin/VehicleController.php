<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.vehicle.list')
        ->with(['title' => VEHICLES_TITLE,
                'vehicles' => Vehicle::all(),
                'clients' => Client::all()
                ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicle();

        $vehicle->client()->associate(Client::find($request->clientId));
        
        $vehicle->patent = $request->patent;
        $vehicle->tara = $request->tara;
        $vehicle->model = $request->model;
        $vehicle->client_name = $vehicle->client->name;
        
        $vehicle->save();

        return redirect('admin/vehicles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('dashboard.vehicle.edit')
        ->with(['title' => VEHICLES_TITLE,
                'vehicle' => $vehicle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'patent'=>'required',
            'tara'=> 'required'
        ]);

        $vehicle->patent = $request->patent;
        $vehicle->tara = $request->tara;


        $vehicle->update();

        return redirect('admin/vehicles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect('admin/vehicles');
    }
}
