<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Colour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColourController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any colour !');
        }
        if ($this->user->can('colour.view') || $this->user->can('colour.create') || $this->user->can('colour.edit') || $this->user->can('colour.delete')) {
            $colours = Colour::all();
            return view('backend.pages.colours.index', compact('colours'));

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
        if (is_null($this->user) || !$this->user->can('colour.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any colour !');
        }
        return view('backend.pages.colours.create');
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
            'name' => 'required|max:100|unique:colours',
        ]);

        // Create New User
        $data = new Colour();
        $data->name = $request->name;
        $data->save();

        session()->flash('success', 'Colour has been created !!');
        return redirect()->route('admin.colours.index');
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
        if (is_null($this->user) || !$this->user->can('colour.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any colour !');
        }

        $colour = Colour::find($id);
        return view('backend.pages.colours.edit', compact('colour'));
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
        $data = Colour::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:colours,name,' . $id,
        ]);

        $data->name = $request->name;
        $data->update();

        session()->flash('info', 'Colour name has been updated !!');
        return redirect()->route('admin.colours.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('colour.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any colour !');
        }

        $data = Colour::find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'Colour has been deleted !!');
        return back();
    }
}
