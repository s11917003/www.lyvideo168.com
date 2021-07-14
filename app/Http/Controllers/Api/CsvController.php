<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Model\AdLaunch;
use App\Model\AdDetailBanner;
use App\Model\Video;
use App\Model\Video_tag_relations;
use App\Model\Video_tag;
use App\Model\PackageInfo;
use PDO;

class CsvController extends Controller {
	public function geCsv(Request $request) {
		// $filePath = storage_path('test.xlsx');
		$lang = ['日文'=>3,'英文'=>2,'中文'=>1];
		$fileName = "main.xlsx";
		$filePath = "../storage/";
	
	
		$fp = @fopen($filePath.$fileName, "r");
		if($fp) {
			$collection = (new FastExcel)->import($filePath.$fileName);
			$data = [];	
			$tagData = [];
			$video_id = Video::orderby('id', 'desc')->first()->id;
			$Video_tag = Video_tag::all();
			foreach ($collection as $index => $item) {
				if( $index <= 10){
					$data[] =  [ 
								'id' => $video_id + ($index+1),
								'video_id'=> $item['影片ID'],
								'video_source'=>$item['影片來源'],
								'video_lang'=> $lang[$item['影片語系']] ,
								'title'=> $item['影片標題'], 
								'title'=> $item['影片標題'], 
								'actress'=> $item['演員'], 
								'description'=> $item['影片描述'] ,
								'video_url'=>  $item['影片連結'] ,  
								'cover_img'=> $item['影片封面'] ,  
								'thumbnail_img'=> $item['縮圖'], 
								'cate_id'=> $item['影片分類'],
								'video_page_url'=>$item['影片頁面連結'] , 
								'dvd_id'=>  $item['番號'] ,  
								'release_date'=>  $item['發行日'] ,  
								'director'=> $item['導演'], 
								'studio'=> $item['片商'], 
								'label'=>   $item['廠牌'],  
								'series'=>  $item['系列'], 
							];
						
				 
						try{
							$newVideo = Video::insert( [ 
								'id' => $video_id + ($index+1),
								'video_id'=> $item['影片ID'],
								'video_source'=>$item['影片來源'],
								'video_lang'=> $lang[$item['影片語系']] ,
								'title'=> $item['影片標題'], 
								'title'=> $item['影片標題'], 
								'actress'=> $item['演員'], 
								'description'=> $item['影片描述'] ,
								'video_url'=>  $item['影片連結'] ,  
								'cover_img'=> $item['影片封面'] ,  
								'thumbnail_img'=> $item['縮圖'], 
								'cate_id'=> $item['影片分類'],
								'video_page_url'=>$item['影片頁面連結'] , 
								'dvd_id'=>  $item['番號'] ,  
								'release_date'=>  $item['發行日'] ,  
								'director'=> $item['導演'], 
								'studio'=> $item['片商'], 
								'label'=>   $item['廠牌'],  
								'series'=>  $item['系列'], 
							]);

							
							if($newVideo && $item['標籤']!=''){

							
								$tagArray  = explode("@", $item['標籤']);
								
								foreach ($tagArray as $itme) {
									$tag = $Video_tag->where('uncoded-jp',$itme)->first();

								
									if($tag){
										$tagData[] = ['video_id'=> $video_id + ($index+1), 'tag_id' => $tag->id];
									}
								}
							
							}
							
						} catch (\Illuminate\Database\QueryException $ex) {
							//dd($ex->getMessage()); 
						}
					
				 
					
				}	
			}
		
			Video_tag_relations::insert($tagData);  
			dd($tagData); 
			return response()->json([
					'data'=> $data,
					'tagData'=> $tagData
			]);
		 
			
		}
				
		}
}
	