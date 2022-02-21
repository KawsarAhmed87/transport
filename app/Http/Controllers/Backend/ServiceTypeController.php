<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class servicetypeController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any service type !');
        }
        if ($this->user->can('servicetype.view') || $this->user->can('servicetype.create') || $this->user->can('servicetype.edit') || $this->user->can('servicetype.delete')) {
            $servicetypes = Sparepart::where('parent_id', 0)->get();
            return view('backend.pages.servicetypes.index', compact('servicetypes'));

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
        if (is_null($this->user) || !$this->user->can('servicetype.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any service type !');
        }
        return view('backend.pages.servicetypes.create');
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
        ]);

        // Create New User
        $data = new Sparepart();
        $data->name = $request->name;
        $data->parent_id = 0;
        $data->save();

        session()->flash('success', 'Service type has been created !!');
        return redirect()->route('admin.servicetypes.index');
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
        if (is_null($this->user) || !$this->user->can('servicetype.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any service type !');
        }

        $servicetype = Sparepart::where('parent_id', 0)->find($id);
        return view('backend.pages.servicetypes.edit', compact('servicetype'));
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
        $data = Sparepart::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:spareparts,name,' . $id,
        ]);

        $data->name = $request->name;
        $data->parent_id = 0;
        $data->update();

        session()->flash('info', 'service type name has been updated !!');
        return redirect()->route('admin.servicetypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('servicetype.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any service type !');
        }

        $data = Sparepart::where('parent_id', 0)->find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'Service type has been deleted !!');
        return back();
    }
}
