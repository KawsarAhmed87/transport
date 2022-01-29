<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any user !');
        }
        if ($this->user->can('division.view') || $this->user->can('division.create') || $this->user->can('division.edit') || $this->user->can('division.delete')) {
            $divisions = Division::all();
            return view('backend.pages.divisions.index', compact('divisions'));

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
        if (is_null($this->user) || !$this->user->can('division.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any division !');
        }
        return view('backend.pages.divisions.create');
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
            'name' => 'required|max:150|unique:divisions',
        ]);

        // Create New User
        $data = new Division();
        $data->name = $request->name;
        $data->save();

        session()->flash('success', 'Division has been created !!');
        return redirect()->route('admin.divisions.index');
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
        if (is_null($this->user) || !$this->user->can('division.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any user !');
        }

        $division = Division::find($id);
        return view('backend.pages.divisions.edit', compact('division'));
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
        $data = Division::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:divisions,name,' . $id,
        ]);

        $data->name = $request->name;
        $data->update();

        session()->flash('info', 'Division name has been updated !!');
        return redirect()->route('admin.divisions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('division.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any user !');
        }

        $data = Division::find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'Division has been deleted !!');
        return back();
    }

    public function changeStatus($id)
    {
        if (is_null($this->user) || !$this->user->can('division.edit')) {
            abort(403, 'Sorry !! You are unauthorized to delete any user !');
        }
        $data = Division::find($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->update();

        session()->flash('info', 'Division has been updated !!');
        return back();
    }
}
