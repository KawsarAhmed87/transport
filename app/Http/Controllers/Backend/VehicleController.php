<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Colour;
use App\Model\Vehicle;
use App\Model\Vehicletype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any vehicle !');
        }
        if ($this->user->can('vehicle.view') || $this->user->can('vehicle.create') || $this->user->can('vehicle.edit') || $this->user->can('vehicle.delete')) {
            $vehicles = Vehicle::all();
            return view('backend.pages.vehicles.index', compact('vehicles'));

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

        if (is_null($this->user) || !$this->user->can('vehicle.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any vehicle !');
        }
        $vehicle_types = Vehicletype::where('parent_id', 0)->get();
        $vehicle_categories = Vehicletype::where('parent_id', '!=', 0)->get();
        $brands = Brand::all();
        $colours = Colour::all();
        return view('backend.pages.vehicles.create', compact('vehicle_types', 'vehicle_categories', 'brands', 'colours'));
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
            'registration' => 'required|max:100|unique:vehicles',
            'purchase_type' => 'required|max:50',
            'brand_id' => 'max:20',
            'vehicle_cc' => 'max:20',
            'vehi_type_id' => 'required|max:20',
            'vehi_cat_id' => 'required|max:20',
            'engine_type' => 'max:30',
            'seat' => 'max:10',
            'fuel_type' => 'max:20',
            'fuel_limit' => 'max:25',
            'colour_id' => 'max:20',
            'vehicle_model' => 'max:10',
            'chasis_no' => 'max:50',
            'engine_no' => 'max:50',
            'tax' => 'max:30',
            'fitness' => 'max:30',
            'cylinder' => 'max:30',
            'remarks' => 'max:150',
        ]);

        // Create New User
        $data = new Vehicle();
        $data->registration = $request->registration;
        $data->purchase_type = $request->purchase_type;
        $data->brand_id = $request->brand_id;
        $data->vehicle_cc = $request->vehicle_cc;
        $data->vehi_type_id = $request->vehi_type_id;
        $data->vehi_cat_id = $request->vehi_cat_id;
        $data->engine_type = $request->engine_type;
        $data->seat = $request->seat;
        $data->fuel_type = $request->fuel_type;
        $data->fuel_limit = $request->fuel_limit;
        $data->colour_id = $request->colour_id;
        $data->vehicle_model = $request->vehicle_model;
        $data->chasis_no = $request->chasis_no;
        $data->engine_no = $request->engine_no;
        $data->tax = $request->tax;
        $data->fitness = $request->fitness;
        $data->cylinder = $request->cylinder;
        $data->remarks = $request->remarks;
        $data->save();

        session()->flash('success', 'Vehicle registration has been created !!');
        return redirect()->route('admin.vehicles.index');
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
        if (is_null($this->user) || !$this->user->can('vehicle.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any vehicle !');
        }

        $vehicle = Vehicle::find($id);
        $vehicle_types = Vehicletype::where('parent_id', 0)->get();
        $vehicle_categories = Vehicletype::where('parent_id', '!=', 0)->get();
        $brands = Brand::all();
        $colours = Colour::all();
        return view('backend.pages.vehicles.edit', compact('vehicle', 'vehicle_types', 'vehicle_categories', 'brands', 'colours'));
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
         // Create New vehicle
         $data = Vehicle::find($id);

         // Validation Data
         $request->validate([
            'registration' => 'required|max:100|unique:vehicles,registration,' . $id,
            'purchase_type' => 'required|max:50',
            'brand_id' => 'max:20',
            'vehicle_cc' => 'max:20',
            'vehi_type_id' => 'required|max:20',
            'vehi_cat_id' => 'required|max:20',
            'engine_type' => 'max:30',
            'seat' => 'max:10',
            'fuel_type' => 'max:20',
            'fuel_limit' => 'max:25',
            'colour_id' => 'max:20',
            'vehicle_model' => 'max:10',
            'chasis_no' => 'max:50',
            'engine_no' => 'max:50',
            'tax' => 'max:30',
            'fitness' => 'max:30',
            'cylinder' => 'max:30',
            'remarks' => 'max:150',
         ]);
 
        $data->registration = $request->registration;
        $data->purchase_type = $request->purchase_type;
        $data->brand_id = $request->brand_id;
        $data->vehicle_cc = $request->vehicle_cc;
        $data->vehi_type_id = $request->vehi_type_id;
        $data->vehi_cat_id = $request->vehi_cat_id;
        $data->engine_type = $request->engine_type;
        $data->seat = $request->seat;
        $data->fuel_type = $request->fuel_type;
        $data->fuel_limit = $request->fuel_limit;
        $data->colour_id = $request->colour_id;
        $data->vehicle_model = $request->vehicle_model;
        $data->chasis_no = $request->chasis_no;
        $data->engine_no = $request->engine_no;
        $data->tax = $request->tax;
        $data->fitness = $request->fitness;
        $data->cylinder = $request->cylinder;
        $data->remarks = $request->remarks;
        $data->update();
 
         session()->flash('info', 'Vehicle has been updated !!');
         return redirect()->route('admin.vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function category(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id) {
                $output = '<option value="">Select One</option>';
                $vehicle_categories = Vehicletype::where('parent_id', $request->id)->orderBy('name', 'asc')->get();
                if (!$vehicle_categories->isEmpty()) {
                    foreach ($vehicle_categories as $data) {
                        $output .= '<option value="' . $data->id . '">' . $data->name . '</option>';
                    }
                }

                return response()->json($output);
            }

        }
    }

    public function showColour(Request $request)
    {
        if ($request->ajax()) {
            $output = '<option value="">Select One</option>';
            $colours = Colour::orderBy('id', 'DESC')->get();
            if (!$colours->isEmpty()) {
                foreach ($colours as $data) {
                    $output .= '<option value="' . $data->id . '">' . $data->name . '</option>';
                }
            }

            return response()->json($output);

        }
    }
    public function addColour(Request $request)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:colours',
        ]);

        $data = new Colour;
        $data->name = $request->name;
        if ($data->save()) {
            return Response()->json();
        } else {
            return redirect()->back();
        }

    }

}
