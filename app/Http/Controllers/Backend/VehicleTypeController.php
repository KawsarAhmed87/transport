<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Vehicletype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleTypeController extends Controller
{
    public $user;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user)) {
            abort(403, 'Sorry !! You are unauthorized to view any vehicle type !');
        }
        if ($this->user->can('vehicletype.view') || $this->user->can('vehicletype.create') || $this->user->can('vehicletype.edit') || $this->user->can('vehicletype.delete')) {
            $vehicletypes = Vehicletype::all();
            return view('backend.pages.vehicletypes.index', compact('vehicletypes'));

        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('vehicletype.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any vehicle type !');
        }
        return view('backend.pages.vehicletypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:vehicletypes',
        ]);

        // Create New User
        $data = new Vehicletype();
        $data->name = $request->name;
        $data->save();

        session()->flash('success', 'vehicle type has been created !!');
        return redirect()->route('admin.vehicletypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('vehicletype.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any vehicle type !');
        }

        $vehicletype = Vehicletype::find($id);
        return view('backend.pages.vehicletypes.edit', compact('vehicletype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Create New User
        $data = Vehicletype::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:vehicletypes,name,' . $id,
        ]);

        $data->name = $request->name;
        $data->update();

        session()->flash('info', 'vehicle type name has been updated !!');
        return redirect()->route('admin.vehicletypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('vehicletype.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any vehicle type !');
        }

        $data = Vehicletype::find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'Vehicle type has been deleted !!');
        return back();
    }
}
