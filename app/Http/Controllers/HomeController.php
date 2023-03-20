<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function index(){

            // $order = OrderItem::select('category_id')->groupBy('category_id')->orderBy('catefory_id')->get();

            $chart_options = [
        'chart_title' => 'Transactions by dates',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\Order',
        'group_by_field' => 'created_at',
        'group_by_period' => 'month',
        'aggregate_function' => 'sum',
        'aggregate_field' => 'total',
        'chart_type' => 'bar',
    ];

    $chart3 = new LaravelChart($chart_options);
        return view('home',compact('chart3'));
    
    }
}
