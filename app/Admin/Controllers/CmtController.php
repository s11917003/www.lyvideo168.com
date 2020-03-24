<?php

namespace App\Admin\Controllers;

use App\Model\PostsComments;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CmtController extends Controller
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

            $content->header('留言管理');
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

            $content->header('留言管理');
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

            $content->header('留言管理');
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
        return Admin::grid(PostsComments::class, function (Grid $grid) {
	        
			$grid->model()->orderby('id', 'desc');
            $grid->id('id')->sortable();
			$grid->article_id('文章ID');
			$grid->parent_id('母文ID');
			$grid->user_id('留言用戶');
			$grid->content('留言')->editable();
 			$grid->status('狀態')->switch([
				'on' => ['value'=>1, 'text'=>'開放', 'color'=>'success'],
				'off' => ['value'=>0, 'text'=>'關閉', 'color'=>'danger']
			]);
            $grid->count_digg('讚數')->editable();
			$grid->filter(function($filter){
			    $filter->is('article_id', '發文編號');
			    $filter->like('content', '模糊找留言');
			});

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PostsComments::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('content', '留言');
            $form->text('count_digg', '讚數');
            //$form->switch('status','狀態')->options([0 => '關閉', 1 => '開放']);
            //$form->switch('pr_tag','官方標籤')->options([0 => '否', 1 => '是']);

            //$form->number('term_order','排序');
        });
    }
}
