<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Sparepart;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstimateController extends Controller
{
    public function index()
    {

        return view('backend.pages.estimates.create');
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

    public function cart_spare_parts(Request $request)
    {
        $data = DB::table('spareparts')->where('id', $request->spare_parts_id)->first();

        \Cart::add([
            'id' => $data->id,
            'name' => $data->name,
            'price' => $data->parent_id,
            'quantity' => 1,
            'attributes' => array(
                'service' => "Yes",
            ),
        ]);

        return back();
    }

    public function get_cart_spare_parts()
    {
        $data = \Cart::getContent();

        return response()->json($data);
    }

}
