<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Brand;

class BrandController extends Controller
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
            abort(403, 'Sorry !! You are unauthorized to view any brand !');
        }
        if ($this->user->can('brand.view') || $this->user->can('brand.create') || $this->user->can('brand.edit') || $this->user->can('brand.delete')) {
            $brands = Brand::all();
            return view('backend.pages.brands.index', compact('brands'));

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
        if (is_null($this->user) || !$this->user->can('brand.create')) {
            abort(403, 'Sorry !! You are unauthorized to create any brand !');
        }
        return view('backend.pages.brands.create');
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
            'name' => 'required|max:100|unique:brands',
        ]);

        // Create New User
        $data = new Brand();
        $data->name = $request->name;
        $data->save();

        session()->flash('success', 'brand has been created !!');
        return redirect()->route('admin.brands.index');
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
        if (is_null($this->user) || !$this->user->can('brand.edit')) {
            abort(403, 'Sorry !! You are unauthorized to edit any brand !');
        }

        $brand = Brand::find($id);
        return view('backend.pages.brands.edit', compact('brand'));
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
        $data = Brand::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50|unique:brands,name,' . $id,
        ]);

        $data->name = $request->name;
        $data->update();

        session()->flash('info', 'brand name has been updated !!');
        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('brand.delete')) {
            abort(403, 'Sorry !! You are unauthorized to delete any brand !');
        }

        $data = Brand::find($id);
        if (!is_null($data)) {
            $data->delete();
        }

        session()->flash('delete', 'brand has been deleted !!');
        return back();
    }
}
