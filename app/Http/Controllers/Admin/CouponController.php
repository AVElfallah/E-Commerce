<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\renewCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupons.create');

    }
    public function store(Request $request)
    {
        Coupon::create($request->except(['expire_date']) + (['expire_date' => date('Y-m-d', strtotime($request->expire_date))]));
        return redirect()->route('coupon.index');

    }

    public function renew(renewCouponRequest $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        if ($request->status == 'closed') {
            $coupon->update(['status' => 'closed']);
            $html = '<span class="btn btn-sm round btn-outline-success open-coupon" data-toggle="modal" id="div_' . $coupon->id . '" data-target="#notify" data-id="' . $coupon->id . '">
                        ' . __('اعاده تشغيل الكوبون') . '  <i class="feather icon-rotate-cw"></i>
                    </span>'
            ;
        } else {
            $coupon->update($request->except(['expire_date']) + (['expire_date' => date('Y-m-d H:i:s', strtotime($request->expire_date))]));
            $html = '<span class="btn btn-sm round btn-outline-danger change-coupon-status" data-status="closed" data-id="' . $coupon->id . '">
                        ' . 'ايقاف الكوبون' . '  <i class="feather icon-slash"></i>
                    </span>';
        }

        return response()->json(['message' => __('تم تحديث حالة الكوبون بنجاح'), 'html' => $html, 'id' => $request->id]);
        return redirect()->route('coupon.index');

    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->back()->with('success', 'success');
    }

    public function changeStatus(Request $request)
    {

        $coupon = Coupon::find($request->coupon_id);
        if ($coupon->status == 0) {
            $coupon = DB::table('coupons')
                ->where('id', '=', $request->coupon_id)
                ->update(['status' => 'available']);
        } else {
            $coupon = DB::table('coupons')
                ->where('id', '=', $request->coupon_id)
                ->update(['status' => 'closed']);

        }

        return response()->json(['success' => 'Status change successfully.']);

    }
    
        public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.edit' , compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id)->update($request->except(['expire_date'])  + (['expire_date' => date('Y-m-d H:i:s', strtotime($request->expire_date))]));
        return redirect()->route('coupon.index');
    }

}