<?php

namespace App\Admin\Controllers;

use App\Models\Box;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BoxController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Box';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Box());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('img', __('Img'));
        $grid->column('width', __('Width'));
        $grid->column('height', __('Height'));
        $grid->column('length', __('Length'));
        $grid->column('weight', __('Weight'));
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
        $show = new Show(Box::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('img', __('Img'));
        $show->field('width', __('Width'));
        $show->field('height', __('Height'));
        $show->field('length', __('Length'));
        $show->field('weight', __('Weight'));
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
        $form = new Form(new Box());

        $form->text('name', __('Name'))->required();
        $form->image('img', __('Img'))->required();
        $form->decimal('width', __('Width'))->required();
        $form->decimal('height', __('Height'))->required();
        $form->decimal('length', __('Length'))->required();
        $form->decimal('weight', __('Weight'))->required();

        return $form;
    }
}
