<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Admin\Extensions\UserLogin;
use App\Lib\User;
use App\Model\Users;
use Illuminate\Http\Request;

use App\Lib\UserDB;




class UsersController extends Controller
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

            $content->header('會員管理');
            //$content->description('description');

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

            $content->header('會員管理');
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

            $content->header('會員管理');
            $content->description('編輯');
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
        return Admin::grid(Users::class, function (Grid $grid) {
			$grid->model()->orderBy('user_id', 'desc');
            $grid->user_id('會員ID')->sortable();
			$grid->avatar('頭像')->display(function($url){
				return "<img src='$url' style='width:50px;'>";
			});
            $grid->nick_name('暱稱')->editable();
            $grid->login_account('帳號');
            $grid->email('信箱');
			$grid->block('封禁')->editable()->switch([
				'on' => ['value'=>1, 'text'=>'封鎖', 'color'=>'danger'],
				'off' => ['value'=>0, 'text'=>'正常', 'color'=>'success']
			]);
            $grid->created_at();
            //$grid->updated_at();
            
			$grid->disableExport();
			$grid->disableCreation();
			//$grid->disableActions();
			$grid->disableRowSelector();

            $grid->actions(function ($actions) {
				$actions->disableDelete();
				//$actions->disableEdit();
				$actions->append(new UserLogin($actions->getKey(),  $actions->row->login_account));

			});		
			
			$grid->filter(function($filter){
				$filter->useModal();
				$filter->between('created_at', 'Created Time')->datetime();
				$filter->like('nick_name', '暱稱查找(模糊)');
				$filter->is('email', 'Email');
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
        return Admin::form(Users::class, function (Form $form) {

            $form->display('user_id', 'ID');
            $form->display('login_account', '帳號');
			$form->text('nick_name','暱稱');
			$form->image('avatar','頭像');
            $form->switch('block', '封禁')->options([0 => '正常', 1 => '鎖定']);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
			$form->saved(function (Form $form) {
				$us = Users::find($form->model()->user_id);
				$u = new UserDB();
				//$user = $u->getUser($form->model()->login_account);
				if(@$form->nick_name != null) {
					$u->updateUser($form->model()->login_account, ['NICK_NAME'=>$form->nick_name]);
				}
				
				if(@$form->avatar) {
					//var_dump($us);
					$us->avatar = 'https://source.gporn.cc/'. $us->avatar;
					$us->save();
					$u->updateUser($form->model()->login_account, ['AVATAR'=>'https://source.gporn.cc/'. $us->avatar]);
				}
			});
        });
    }
    
    public function login(Request $request) {
	    $acc = $request->useracc;
	    $u = new User();
	    $user = $u->getUser($acc);
	    \Session::put('USER', $user);
		
		return response()->json([
			'ret'=> 'success'
		]);	    
    }
}
