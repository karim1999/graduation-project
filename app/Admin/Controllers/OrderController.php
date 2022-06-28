<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    public bool $isVendor = false;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $this->isVendor= Admin::user()->isRole('vendor');

        $grid = new Grid(new Order());
        $grid->disableBatchActions();
        $grid->disableCreateButton();
        if($this->isVendor){
            $grid->model()->where('vendor_id', Admin::user()->id);
        }

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User name'));
        $grid->column('from_address.address', __('From address'));
        $grid->column('to_address.address', __('To address'));
        $grid->column('vendor.username', __('Vendor'));
        $grid->column('total', __('Total'))->label();
        $grid->column('status', __('Status'))->label([
            "PENDING" => 'default',
            "REJECTED" => 'danger',
            "APPROVED" => 'success',
        ]);
        $grid->column('created_at', __('Created at'))->diffForHumans();
        $grid->column('updated_at', __('Updated at'))->diffForHumans();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('User name'));
        $show->field('user.email', __('User Email'));
        $show->field('from_address.formatted', __('From address'));
        $show->field('to_address.formatted', __('To address'));
        $show->field('vendor.username', __('Vendor name'));
        $show->field('total', __('Total'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->boxes('Boxes', function ($box) {
            $box->disableBatchActions();
            $box->disableCreateButton();
            $box->disableActions();

            $box->setResource('/admin/order_boxes');

            $box->id();
            $box->column('box.name');
            $box->column('box.price');
            $box->quantity();
        });
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->select('status', __('Status'))->options([
            'PENDING' => 'PENDING',
            'APPROVED' => 'APPROVED',
            'REJECTED' => 'REJECTED',
        ]);

        return $form;
    }
}
