<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Sparepart;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    public function index()
    {

        $info = \Cart::getContent();
        return view('backend.pages.estimates.create', compact('info'));
    }

    public function servicetype()
    {
        $service_type = Sparepart::where('parent_id', 0)->get();
        return response()->json($service_type);
    }

    public function spare_parts(Request $request)
    {
        $get_spartparts = Sparepart::where('parent_id', $request->servicetype_id)->get();

        return response()->json($get_spartparts);
    }

}
