<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any unit !');
        }
        if ($this->user->can('unit.view') || $this->user->can('unit.create') || $this->user->can('unit.edit') || $this->user->can('unit.delete')) {
            $units = Unit::all();
            return view('backend.pages.units.index', compact('units'));

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
        if (is_null($this->user) || !$this->user->can('unit.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any unit !');
        }
        return view('backend.pages.units.create');
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
            'name' => 'required|max:100|unique:units',
        ]);

        // Create New User
        $data = new Unit();
        $data->name = $request->name;
        $data->save();

        session()->flash('success', 'Unit has been created !!');
        return redirect()->route('admin.units.index');
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
        if (is_null($this->user) || !$this->user->can('unit.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any unit !');
        }

        $unit = Unit::find($id);
        return view('backend.pages.units.edit', compact('unit'));
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
        $data = Unit::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:units,name,' . $id,
        ]);

        $data->name = $request->name;
        $data->update();

        session()->flash('info', 'Unit name has been updated !!');
        return redirect()->route('admin.units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('unit.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any unit !');
        }

        $data = Unit::find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'Unit has been deleted !!');
        return back();
    }
}
