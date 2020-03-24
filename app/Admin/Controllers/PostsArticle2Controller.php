<?php

namespace App\Admin\Controllers;

use App\Model\PostsArticle;
use App\Model\PostsDetail;
use App\Model\PostsTag;
use App\Model\PostsTagRelationships;


use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Admin\Extensions\PostDelete;

use Illuminate\Http\Request;
use Illuminate\Http\File;


class PostsArticle2Controller extends Controller
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

            $content->header('發文審查');
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

            $content->header('發文審查');
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

            $content->header('發文審查');
            $content->description('description');
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
        return Admin::grid(PostsArticle::class, function (Grid $grid) {
			
			$grid->model()->with('ttag.post_tag_id')->orderBy('id', 'desc');

            $grid->id('ID')->style('width:50px')->sortable();
            $grid->user_id('用戶ID')->style('width:100px')->sortable();
            $grid->cate_id('分類')->style('width:50px');
			
			/*
			$tags = PostsTag::all();
			$tt = [];
			foreach ($tags as $tag) {
				$tt[$tag->id] = $tag->name;
			}
			*/
			      
            //$grid->ttag()->post_tag_id('標籤')->style('width:120px')->display(function($tt){
	        //    return $tt['name'];
            //});
			$grid->ttag()->post_tag_id('標籤1')->style('width:120px')->sortable();
			$grid->title('段子')->editable()->style('width:200px');
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
			})->style('width:325px');;
			$grid->cover_img()->display(function($url){
				return "<img src='$url' style='width:80px;'>";
			});
			$grid->status('審查')->switch([
				'on' => ['value'=>1, 'text'=>'發布', 'color'=>'success'],
				'off' => ['value'=>0, 'text'=>'待審', 'color'=>'danger']
			])->editable();
			$grid->is_focus('推薦')->switch([
				'on' => ['value'=>1, 'text'=>'推薦', 'color'=>'success'],
				'off' => ['value'=>0, 'text'=>'一般', 'color'=>'danger']
			])->editable();
						          
            $grid->created_time('發文時間')->sortable();
            $grid->disableExport();
			$grid->filter(function($filter){
				$filter->is('status','審查')->select([0=>'待審',1=>'發布']);
				//$filter->like('status', 'status');
			    $filter->like('title', '模糊找段子');
			});
			$grid->actions(function ($actions) {
				$actions->disableDelete();
				
			    // append一个操作
			    $actions->append(new PostDelete($actions->getKey()));
			});

            //$grid->updated_at();
        });
    }
	
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PostsArticle::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('title', '文字');		
			
			$uri = $_SERVER['REQUEST_URI'];
			$postid = explode('/', $uri);
			$data = PostsArticle::with('ttag')->find($postid[3]);
			@$dd = $data->ttag->tagname->id;
			
			if(!$dd) {
				$dd = 1;
			}
			//$form->select('ttag.post_tag_id.name','標籤')->options([1=>'a',2=>'b']);
			
            $form->select('ttag.post_tag_id.name','標籤')->options(function($tags){
	            $tags = PostsTag::all();
	            $tt = [];
	            foreach ($tags as $tag) {
		            $tt[$tag->id] = $tag->name;
	            }
	            return $tt;
            })->default($dd);
            
            
            $form->switch('status', '審查')->options([0 => '待審', 1 => '發布']);
            $form->switch('is_focus', '推薦')->options([0 => '一般', 1 => '推薦']);
            $form->image('cover_img', '圖片');
            $form->display('created_time', '發文時間');
        });
    }
    
    public function destroy(Request $request) {
			
			$disk = \Storage::disk('gcs');
			$post = PostsArticle::find($request->postid);
			$host = 'https://source.gporn.cc/';
			
			switch ($post->cate_id) {
				case 1: //段子直接砍了
				break;
				
				case 2: //圖片
					$coverimg = str_replace($host, '', $post->cover_img);
					$disk->delete($coverimg);					
										
				break;
					
				case 3:
					$videopath = str_replace($host, '', $post->video_url);
					$coverimg = str_replace($host, '', $post->cover_img);
					//$disk->delete([$coverimg, $videopath]);
					$disk->deleteDirectory(str_replace('.jpg', '', $coverimg));

				break;
			}			
			
			$post->delete();
			PostsDetail::find($request->postid)->delete();
			PostsTagRelationships::where('post_id', $request->postid)->delete();		
			
			return response()->json([
				'ret' => 1,
				'msg' => 'success'
			]);
    }
        
}
