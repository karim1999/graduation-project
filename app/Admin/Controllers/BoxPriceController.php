<?php

namespace App\Admin\Controllers;

use App\Models\Box;
use App\Models\BoxPrice;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BoxPriceController extends AdminController
{
    public bool $isVendor = false;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rates';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $this->isVendor= Admin::user()->isRole('vendor');
        $grid = new Grid(new BoxPrice());

        $grid->column('id', __('Id'));
        if(!$this->isVendor) {
            $grid->column('vendor.username', __('Vendor username'));
        }
        if($this->isVendor) {
            $grid->model()->where('vendor_id', Admin::user()->id);
        }
        $grid->column('box.name', __('Box name'));
        $grid->column('price', __('Price'))->label();
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
        $show = new Show(BoxPrice::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('vendor_id', __('Vendor id'));
        $show->field('box_id', __('Box id'));
        $show->field('price', __('Price'));
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
        $this->isVendor= Admin::user()->isRole('vendor');
        $form = new Form(new BoxPrice());

        $roleModal = (new (config('admin.database.roles_model')))->where('name', 'vendor')->first();
        if(!$this->isVendor && $roleModal) {
            $form->select('vendor_id', "Vendor")->options($roleModal->administrators()->get()->pluck('name', 'id'));
        }else{
            $form->hidden('vendor_id', "Vendor")->value(Admin::user()->id);

        }
        $form->select('box_id', "Box")->options(Box::all()->pluck('name', 'id'));
        $form->decimal('price', __('Price'));

        return $form;
    }
}
