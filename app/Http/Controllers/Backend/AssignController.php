<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Assign;
use App\Model\Division;
use App\Model\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any assign !');
        }
        if ($this->user->can('assign.view') || $this->user->can('assign.create') || $this->user->can('assign.edit') || $this->user->can('assign.delete')) {
            $assigns = Assign::all();
            return view('backend.pages.assigns.index', compact('assigns'));

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

        if (is_null($this->user) || !$this->user->can('assign.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any assign !');
        }
        $divisions = Division::all();
        $vehicles = DB::table('vehicles')->where(['status' => 1, 'assign_status' => 0])->get();
        return view('backend.pages.assigns.create', compact('divisions', 'vehicles'));
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
            'division_id' => 'required|max:20',
            'vehicle_id' => 'required|max:20',
            'officer_info' => 'max:20',
            'officer_phone' => 'max:20',
            'assign_start_date' => 'max:20',
            'memo' => 'max:20',
            'remarks' => 'max:20',
            'status' => 'required|max:20',
        ]);

        // Create New User
        $data = new Assign();
        $data->division_id = $request->division_id;
        $data->vehicle_id = $request->vehicle_id;
        $data->officer_info = $request->officer_info;
        $data->officer_phone = $request->officer_phone;
        $data->assign_start_date = $request->assign_start_date;
        $data->memo = $request->memo;
        $data->remarks = $request->remarks;
        $data->status = $request->status;
        $data->save();

        DB::table('vehicles')->where('id', $request->vehicle_id)->update(['assign_status' => 1]);

        session()->flash('success', 'Vehicle assign has been created !!');
        return redirect()->route('admin.assigns.index');
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
        if (is_null($this->user) || !$this->user->can('assign.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any assign !');
        }

        $assign = Assign::find($id);
        $divisions = Division::all();
        $vehicles = DB::table('vehicles')->where(['status' => 1, 'assign_status' => 0])->orwhere('id', $assign->vehicle_id)->get();
        return view('backend.pages.assigns.edit', compact('assign', 'divisions', 'vehicles'));
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
        $data = Assign::find($id);

        // Validation Data
        $request->validate([
            'division_id' => 'required|max:20',
            'vehicle_id' => 'required|max:20',
            'officer_info' => 'max:20',
            'officer_phone' => 'max:20',
            'assign_start_date' => 'max:20',
            'memo' => 'max:20',
            'remarks' => 'max:20',
            'status' => 'required|max:20',
        ]);

        $data->division_id = $request->division_id;
        $data->vehicle_id = $request->vehicle_id;
        $data->officer_info = $request->officer_info;
        $data->officer_phone = $request->officer_phone;
        $data->assign_start_date = $request->assign_start_date;
        $data->memo = $request->memo;
        $data->remarks = $request->remarks;
        $data->status = $request->status;
        $data->update();

        if ($request->status == 'Active') {
            DB::table('vehicles')->where('id', $request->vehicle_id)->update(['assign_status' => 1]);
        }else{
            DB::table('vehicles')->where('id', $request->vehicle_id)->update(['assign_status' => 0]);
        }
        session()->flash('info', 'Vehicle assign has been updated !!');
        return redirect()->route('admin.assigns.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('assign.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any assign !');
        }

        $data = Assign::find($id);

        if (!is_null($data)) {
            $info =DB::table('assigns')->where('id', $data->id)->where('vehicle_id', $data->vehicle_id)->where('status', 'Active')->first();
            if (!is_null($info)) {
                DB::table('vehicles')->where('id', $data->vehicle_id)->update(['assign_status' => 0]);
            }
            $data->delete();   
        }

        session()->flash('delete', 'Vehicle assign has been deleted !!');
        return back();
    }
}
