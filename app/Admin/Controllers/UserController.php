<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    public bool $isVendor = false;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $this->isVendor= Admin::user()->isRole('vendor');
        $grid = new Grid(new User());
        if($this->isVendor){
            $grid->disableBatchActions();
            $grid->disableCreateButton();
            $grid->disableActions();
        }

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'))->required();
        $form->email('email', __('Email'))->required()->rules('unique:users,email,{{id}}');
        $form->password('password', __('Password'))->creationRules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->creationRules('required')->updateRules('required_with:password');

        $form->ignore(['password_confirmation']);

        $form->morphMany('addresses', function (Form\NestedForm $form) {
            $form->text('country', __('Country'));
            $form->text('city', __('City'));
            $form->text('state', __('State'));
            $form->text('address', __('Address'));
            $form->decimal('lat', __('Lat'));
            $form->decimal('lng', __('Lng'));
        });
        return $form;
    }
}
