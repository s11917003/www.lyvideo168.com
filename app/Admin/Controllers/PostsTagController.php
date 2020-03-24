<?php

namespace App\Admin\Controllers;

use App\Model\PostsTag;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PostsTagController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('標籤管理');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('標籤管理');
            //$content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('標籤管理');
            $content->description('新增');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(PostsTag::class, function (Grid $grid) {
			$grid->model()->orderby('term_order', 'desc');
            $grid->id('id')->sortable();
            $grid->name('標籤名')->editable();
 			$grid->status('狀態')->switch([
				'on' => ['value'=>1, 'text'=>'開放', 'color'=>'success'],
				'off' => ['value'=>0, 'text'=>'關閉', 'color'=>'danger']
			]);
 			$grid->pr_tag('官方標籤')->switch([
				'on' => ['value'=>1, 'text'=>'是', 'color'=>'success'],
				'off' => ['value'=>0, 'text'=>'否', 'color'=>'danger']
			]);			
			$grid->term_order('排序(大優先)')->editable();
                $grid->article_nums('文章數');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PostsTag::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name', '標籤名');
            $form->switch('status','狀態')->options([0 => '關閉', 1 => '開放']);
            $form->switch('pr_tag','官方標籤')->options([0 => '否', 1 => '是']);

            $form->number('term_order','排序');
        });
    }
}
