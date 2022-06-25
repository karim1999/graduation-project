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
        if($this->isVendor){
            $grid->disableBatchActions();
            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->model()->where('vendor_id', Admin::user()->id);
        }

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('from_address_id', __('From address id'));
        $grid->column('to_address_id', __('To address id'));
        $grid->column('vendor_id', __('Vendor id'));
        $grid->column('total', __('Total'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->field('user_id', __('User id'));
        $show->field('from_address_id', __('From address id'));
        $show->field('to_address_id', __('To address id'));
        $show->field('vendor_id', __('Vendor id'));
        $show->field('total', __('Total'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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

        $form->number('user_id', __('User id'));
        $form->number('from_address_id', __('From address id'));
        $form->number('to_address_id', __('To address id'));
        $form->number('vendor_id', __('Vendor id'));
        $form->decimal('total', __('Total'));
        $form->text('status', __('Status'))->default('PENDING');

        return $form;
    }
}
