<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderItem;
use App\Models\Order;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DB;

class HomeController extends Controller
{
    public function index(){

            $order = OrderItem::select('category_id',DB::raw("SUM(sub_total) as total"))->groupBy('category_id')->orderBy('category_id')->get();
            $sales = Order::select(
            DB::raw('month(created_at) as month'),
            DB::raw('sum(total) as price'),
        )
        ->where(DB::raw('date(created_at)'), '>=', "2019-01-01")
        ->groupBy('month')
        ->get();
        
        $previousMonthUsers = Order::whereMonth('created_at', now()->month - 1)->count();
        $thisMonthUsers = Order::whereMonth('created_at', now()->month)->count();
        if ($previousMonthUsers > 0) {
            // If it has decreased then it will give you a percentage with '-'
        $differenceInpercentage = ($thisMonthUsers - $previousMonthUsers) * 100 / $previousMonthUsers;
        } else {
        $differenceInpercentage = $thisMonthUsers > 0 ? '100%' : '0%';
            }
            
                    $previousDayOrders = Order::whereDay('created_at', now()->day - 1)->count();
        $thisDayOrders = Order::whereDay('created_at', now()->day)->count();
        if ($previousDayOrders > 0) {
            // If it has decreased then it will give you a percentage with '-'
        $differenceInpercentage1 = ($thisDayOrders - $previousDayOrders) * 100 / $previousDayOrders;
        } else {
        $differenceInpercentage1 = $thisDayOrders > 0 ? '100%' : '0%';
            }


            $chart_options1 = [
        'chart_title' => 'Transactions',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\Order',
        'group_by_field' => 'created_at',
        'group_by_period' => 'month',
        'aggregate_function' => 'sum',
        'aggregate_field' => 'total',
        'chart_type' => 'bar',
    ];

    $chart1 = new LaravelChart($chart_options1);
    
    $chart_options = [
        'chart_title' => 'Users by months',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\Client',
        'group_by_field' => 'created_at',
        'group_by_period' => 'month',
        'chart_type' => 'bar',
        'filter_field' => 'created_at',
        'filter_days' => 30, // show only last 30 days
    ];

    $chart3 = new LaravelChart($chart_options);

    
    $chart_options = [
        'chart_title' => 'Transactions by dates',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\OrderItem',
        'group_by_field' => 'category_id',
        'group_by_period' => 'month',
        'aggregate_function' => 'sum',
        'aggregate_field' => 'sub_total',
        'chart_type' => 'pie',
    ];

    $chart2 = new LaravelChart($chart_options);
        return view('home',compact('chart1','order','sales','differenceInpercentage','chart2','chart3','differenceInpercentage1'));
    
    }
}
