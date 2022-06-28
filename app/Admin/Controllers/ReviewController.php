<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    public bool $isVendor = false;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $this->isVendor= Admin::user()->isRole('vendor');
        $grid = new Grid(new Review());
        $grid->disableBatchActions();
        $grid->disableCreateButton();
        if($this->isVendor){
            $grid->disableActions();
            $grid->model()->whereHas('order', function ($query){
                return $query->where('vendor_id', Admin::user()->id);
            });
        }

        $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('rate', __('Rate'));
        $grid->column('description', __('Description'));
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
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order id'));
        $show->field('rate', __('Rate'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Review());

        $form->select('status', __('Status'))->options([
            'PENDING' => 'PENDING',
            'APPROVED' => 'APPROVED',
            'REJECTED' => 'REJECTED',
        ]);

        return $form;
    }
}
