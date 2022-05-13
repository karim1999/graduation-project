<?php

namespace App\Admin\Controllers;

use App\Models\Address;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AddressController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Address';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Address());

        $grid->column('id', __('Id'));
        $grid->column('country', __('Country'));
        $grid->column('city', __('City'));
        $grid->column('state', __('State'));
        $grid->column('address', __('Address'));
        $grid->column('lat', __('Lat'));
        $grid->column('lng', __('Lng'));
        $grid->column('addressable_type', __('Addressable type'));
        $grid->column('addressable_id', __('Addressable id'));
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
        $show = new Show(Address::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('country', __('Country'));
        $show->field('city', __('City'));
        $show->field('state', __('State'));
        $show->field('address', __('Address'));
        $show->field('lat', __('Lat'));
        $show->field('lng', __('Lng'));
        $show->field('addressable_type', __('Addressable type'));
        $show->field('addressable_id', __('Addressable id'));
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
        $form = new Form(new Address());

        $form->text('country', __('Country'));
        $form->text('city', __('City'));
        $form->text('state', __('State'));
        $form->text('address', __('Address'));
        $form->text('lat', __('Lat'));
        $form->text('lng', __('Lng'));
        $form->text('addressable_type', __('Addressable type'));
        $form->number('addressable_id', __('Addressable id'));

        return $form;
    }
}