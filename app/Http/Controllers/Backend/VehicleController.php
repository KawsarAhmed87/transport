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
        //
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
        //
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
        //
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
            $vehicle_categories = Colour::orderBy('id', 'DESC')->get();
            if (!$vehicle_categories->isEmpty()) {
                foreach ($vehicle_categories as $data) {
                    $output .= '<option value="' . $data->id . '">' . $data->name . '</option>';
                }
            }

            return response()->json($output);

        }
    }
    public function addColour(Request $request)
    {
        $data = new Colour;
        $data->name = $request->name;
        $data->save();

        return Response()->json();

    }

}
