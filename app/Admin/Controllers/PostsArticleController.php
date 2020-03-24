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
use App\Admin\Extensions\Tools\AddCount;


use Illuminate\Http\Request;
use Illuminate\Http\File;


class PostsArticleController extends Controller
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
            //$grid->cate_id('分類')->style('width:50px');
            /*
            $grid->tag()->post_tag_id('標籤')->style('width:120px')->display(function($tt){
	            return $tt['name'];
            })->sortable();
            */
            
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
			])->editable()->sortable();
			
			$grid->is_hot('權重')->select([
			    0,1,2,3,4,5,6,7,8,9,10
			])->sortable();
			
			$grid->covered('轉檔')->display(function($sta){
				if($sta == 1) {
					return '完成';
				} elseif($sta == 3) {
					return '轉檔';
				} else {
					return '隊列';
				}
			});

					          
            $grid->created_time('發文時間')->sortable();
            $grid->disableExport();
			$grid->filter(function($filter){
				$filter->is('status','審查')->select([0=>'待審',1=>'發布']);
				//$filter->like('status', 'status');
			    $filter->like('title', '模糊找段子');
				$filter->is('is_hot', '搜權重');
				$filter->is('cate_id', '搜分類');


			});
			$grid->actions(function ($actions) {
				$actions->disableDelete();
				
			    // append一个操作
			    $actions->append("<a href='/admin/postcmt?article_id=" . $actions->getKey() . "' target='_blank'><i class='fa fa-bullhorn'></i></a>");
				$actions->append("<a href='/p/" . $actions->getKey() . "' target='_blank'><i class='fa fa-reply'></i></a>");

			    $actions->append(new PostDelete($actions->getKey()));
			});

			$grid->tools(function ($tools) {
			    $tools->batch(function ($batch) {
			        $batch->disableDelete();
			    });
			    $tools->batch(function ($batch) {
					$batch->add('新增讚噓', new addcount());
			    });
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
            $form->textarea('title', '文字')->rows(10);
            
			$uri = $_SERVER['REQUEST_URI'];
			$postid = explode('/', $uri);
            $form->switch('status', '發布')->options([0 => '待審', 1 => '發布']);
            $form->switch('is_focus', '推薦')->options([0 => '一般', 1 => '推薦']);
            $form->select('is_hot','權重')->options([0,1,2,3,4,5,6,7,8,9,10]);
            $form->image('cover_img', '圖片');
            $form->display('created_time', '發文時間');
        });
    }
    
    public function destroy(Request $request) {
			
			$disk = \Storage::disk('gcs');
			$post = PostsArticle::find($request->postid);
			$host = 'https://source.gporn.cc';
			
			switch ($post->cate_id) {
				case 1: //段子直接砍了
				break;
				
				case 2: //圖片
					$coverimg = str_replace($host, '', $post->cover_img);
					$disk->delete($coverimg);					
										
				break;
					
				case 3:
					$videopath = str_replace('http://35.227.193.144', '', $post->video_url);
					$coverimg = str_replace($host, '', $post->cover_img);  //ok
					$cc = str_replace('/'.explode('/', $coverimg)[5], '', $coverimg);
					//$disk->deleteDirectory($cc);
					exec("gsutil rm -r gs://source.gporn.cc$cc");
				break;
			}			
			
			$post->delete();
			
			PostsDetail::find($request->postid)->delete();
			PostsTagRelationships::find($request->postid)->delete();
			
			return response()->json([
				'ret' => 1,
				'msg' => 'success'
			]);
    }
    
    public function addfakeCount() {
	    
	    DB::table('posts_detail')->where('digg_count', '<', 10)
	    						->update([
		    						'digg_count' => rand(1250,8000),
		    						'count_bury' => rand(200, 550)
	    						]);
		return response()->json([
			'ret' => 1,
			'msg' => '讚噓數據插入成功'
		]);
	    //$postsDetail = DB::PostsDetail::whereRaw('UPDATE posts_detail SET count_digg = FLOOR(1500 + (RAND() * 8000)) WHERE count_digg < 2000')->get();
		//UPDATE transactions "."SET tnx_ref = FLOOR(10 + (RAND() * 90))"."WHERE id = $id }
	}
}
