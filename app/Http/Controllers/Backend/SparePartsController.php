<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparePartsController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any sparepart !');
        }
        if ($this->user->can('sparepart.view') || $this->user->can('sparepart.create') || $this->user->can('sparepart.edit') || $this->user->can('sparepart.delete')) {
            $spareparts = Sparepart::where('parent_id', '!=', 0)->get();
            return view('backend.pages.spareparts.index', compact('spareparts'));

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
        if (is_null($this->user) || !$this->user->can('sparepart.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any sparepart !');
        }
        $servicetypes = Sparepart::where('parent_id', 0)->get();
        return view('backend.pages.spareparts.create', compact('servicetypes'));
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
            'name' => 'required|max:100|unique:spareparts',
            'parent_id' => 'required',
        ]);

        // Create New User
        $data = new Sparepart();
        $data->name = $request->name;
        $data->parent_id = $request->parent_id;
        $data->save();

        session()->flash('success', 'Sparepart has been created !!');
        return redirect()->route('admin.spareparts.index');
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
        if (is_null($this->user) || !$this->user->can('sparepart.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any sparepart !');
        }
        $servicetypes = Sparepart::where('parent_id', 0)->get();
        $sparepart = Sparepart::find($id);
        return view('backend.pages.spareparts.edit', compact('servicetypes', 'sparepart'));
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
        $data = Sparepart::where('parent_id', '!=', 0)->find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:spareparts,name,' . $id,
            'parent_id' => 'required',
        ]);

        $data->name = $request->name;
        $data->parent_id = $request->parent_id;
        $data->update();

        session()->flash('info', 'Sparepart name has been updated !!');
        return redirect()->route('admin.spareparts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('sparepart.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any sparepart !');
        }

        $data = Sparepart::where('parent_id', '!=', 0)->find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'sparepart has been deleted !!');
        return back();
    }
}
