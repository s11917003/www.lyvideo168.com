<?php

namespace App\Admin\Controllers;

use App\Model\AdLaunch;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdLaunchController extends Controller
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

            $content->header('蓋板廣告管理');
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

            $content->header('蓋板廣告管理');
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

            $content->header('蓋板廣告管理');
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
        return Admin::grid(AdLaunch::class, function (Grid $grid) {
            $grid->id('id')->sortable();
			$grid->type('裝置')->style('width:50px');
            $grid->campaign_name('廣告名')->style('width:10px')->editable();
            $grid->app_name('APP名')->style('width:10px')->editable();
            $grid->app_icon('APP圖')->display(function($url){
				return "<img src='$url' style='width:50px;'>";
            });
			$grid->bg_img('蓋版圖')->display(function($url){
				return "<img src='$url' style='width:80px;'>";
			});
			$grid->video('影片')->editable();	
			$grid->play_url('安卓網址')->editable();
			$grid->ios_url('ios網址')->editable();
			$grid->web_url('網站網址')->editable();
			$grid->timer('秒數')->editable();
 			$grid->status('狀態')->switch([
				'on' => ['value'=>1, 'text'=>'開放', 'color'=>'success'],
				'off' => ['value'=>0, 'text'=>'關閉', 'color'=>'danger']
			]);

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(AdLaunch::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('campaign_name', '廣告名稱(英文)');
            $form->text('type', '裝置(ios,apk)');
            $form->text('app_name', 'app名稱');
            $form->image('app_icon', 'app圖100x100');
            $form->image('bg_img', '圖片');
            $form->file('video', '影片');
			$form->text('play_url', 'play網址');
            $form->text('ios_url', 'ios網址');
            $form->text('web_url', '網站網址');
            $form->number('timer', '秒數');
            $form->switch('status','狀態')->options([0 => '關閉', 1 => '開放']);
			$form->saved(function (Form $form) {
				$us = AdLaunch::find($form->model()->id);
				if(@$us->app_icon) {
					//var_dump($us);
					if(preg_match("@^https://@i",$us->app_icon) == 0) {
						$disk = \Storage::disk('gcs');
						$disk->setVisibility($us->app_icon, 'public');
						$us->app_icon = 'https://source.gporn.cc/'. $us->app_icon;
						$us->save();
					}
				}				
				if(@$us->bg_img) {
					//var_dump($us);
					if(preg_match("@^https://@i",$us->bg_img) == 0) {
						
						$disk = \Storage::disk('gcs');
						$disk->setVisibility($us->bg_img, 'public');
						$us->bg_img = 'https://source.gporn.cc/'. $us->bg_img;
						$us->save();
					}
				}
				if(@$us->video) {
					if(preg_match("@^https://@i",$us->video) == 0) {
						$disk = \Storage::disk('gcs');
						$disk->setVisibility($us->video, 'public');
						$us->video = 'https://source.gporn.cc/'. $us->video;
						$us->save();
					}

				}
				
				AdLaunch::flushCache('app_apk_config');		
				AdLaunch::flushCache('app_ios_config');		
			});            

        });
    }
}
