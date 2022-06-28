<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public bool $isVendor = false;

    public function index(Content $content)
    {
        $this->isVendor= Admin::user()->isRole('vendor');
        return $content
            ->title('Movers Marketplace')
            ->row(function (Row $row) {

                $row->column(3, function (Column $column) {
                    $users = User::query();
                    $infoBox = new InfoBox('Users', 'users', 'aqua', '/admin/users', $users->count());
                    $column->append($infoBox);
                });

                $row->column(3, function (Column $column) {
                    $orders = Order::query();
                    if($this->isVendor){
                        $orders = $orders->where('vendor_id', Admin::user()->id);
                    }
                    $infoBox = new InfoBox('Orders', 'users', 'green', '/admin/orders', $orders->count());
                    $column->append($infoBox);
                });

                $row->column(3, function (Column $column) {
                    $reviews = Review::query();
                    if($this->isVendor){
                        $reviews = $reviews->whereHas('order', function ($query){
                            return $query->where('vendor_id', Admin::user()->id);
                        });
                    }
                    $infoBox = new InfoBox('Reviews', 'users', 'red', '/admin/reviews', $reviews->count());
                    $column->append($infoBox);
                });

                $row->column(3, function (Column $column) {
                    $boxes = Box::query();
                    $infoBox = new InfoBox('Boxes', 'users', 'yellow', '/admin/boxes', $boxes->count());
                    $column->append($infoBox);
                });
            })->row(function (Row $row) {
                $row->column(12, function (Column $column) {

                    $headers = ['Id', 'Total', 'Status', 'Created At'];
                    $orders = Order::query();
                    if($this->isVendor){
                        $orders = $orders->where('vendor_id', Admin::user()->id);
                    }
                    $rows = $orders->limit(6)->latest()->get(['id', 'total', 'status', 'created_at'])->toArray();

                    $table = new Table($headers, $rows);
                    $box = new \Encore\Admin\Widgets\Box('Latest Orders', $table);

                    $column->append($box);
                });
            });
    }
}
