<?php

namespace App\Admin\Controllers;

use App\Model\AdArticle;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdArticleController extends Controller
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

            $content->header('插入廣告管理');
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

            $content->header('插入廣告管理');
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
        return Admin::grid(AdArticle::class, function (Grid $grid) {
            $grid->id('id')->sortable();
            $grid->campaign_name('廣告名')->style('width:10px')->editable();
			$grid->type_id('標籤名')->style('width:50px')->editable();
			$grid->title('文案')->style('width:150px')->editable();
			$grid->user_name('產品名')->style('width:100px')->editable();
			$grid->head_img('頭像圖')->display(function($url){
				return "<img src='$url' style='width:80px;'>";
			});			
			$grid->cover_img('靜態圖')->display(function($url){
				return "<img src='$url' style='width:80px;'>";
			});
			$grid->video_url('影片/圖')->display(function($url){
				$urlayy = explode('.', $url);
				//var_dump($urlayy);
				if(@$urlayy[3] == 'mp4') {
					return "<video width='320' height='240' controls><source src='$url' type='video/mp4'></video>";
				} elseif ($url != '' && @$urlayy[3] != 'mp4') {
					return "<img src='$url' width='150'>";
				} else {
					return '';
				};
			})->style('width:325px');
			$grid->play_url('安卓網址')->editable();
			$grid->ios_url('ios網址')->editable();			
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
        return Admin::form(AdArticle::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('type_id', '標籤');
            $form->text('campaign_name','廣告名');
            $form->text('user_name', '產品名');
			$form->image('head_img', '頭像');
            $form->image('cover_img', '圖片');
            $form->file('video_url', '影片');
            $form->text('title', '文案');
			$form->text('play_url', 'play網址');
            $form->text('ios_url', 'ios網址');
            $form->datetime('start_time', '開始時間');
			$form->datetime('end_time', '結束時間');

            //$form->text('web_url', '網站網址');

            $form->switch('status','狀態')->options([0 => '關閉', 1 => '開放']);
			$form->saved(function (Form $form) {
				$us = AdArticle::find($form->model()->id);
				if(@$us->head_img) {
					//var_dump($us);
					if(preg_match("@^https://@i",$us->head_img) == 0) {
						$us->head_img = 'https://source.c8c8tv.com/'. $us->head_img;
						$us->save();
					}
				}				
				if(@$us->cover_img) {
					//var_dump($us);
					if(preg_match("@^https://@i",$us->cover_img) == 0) {
						$us->cover_img = 'https://source.c8c8tv.com/'. $us->cover_img;
						$us->save();
					}
				}
				if(@$us->video_url) {
					//var_dump($us);
					if(preg_match("@^https://@i",$us->video_url) == 0) {
						$us->video_url = 'https://source.c8c8tv.com/'. $us->video_url;
						$us->save();
					}
				}
				AdArticle::flushCache('app_post_ad');
							
			});            

        });
    }
}
