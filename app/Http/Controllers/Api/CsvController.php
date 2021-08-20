<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
// use App\Model\AdLaunch;
// use App\Model\AdDetailBanner;
use App\Model\Video;
use App\Model\Video_tag_relations;
use App\Model\Video_tag;
use App\Model\PackageInfo;
use Exception;
// use PDO;

class CsvController extends Controller {
	public function geCsv(Request $request) {
		set_time_limit(0);
		// $filePath = storage_path('test.xlsx');
		$lang = ['日文'=>3,'英文'=>2,'中文'=>1,'Japanese'=>3];
		$fileName = "main.xlsx";
		$filePath = "../storage/";

		//分類 1 中文 2英文 3日本
		//分類  1有碼(FANZA) 2 有碼(Prestige) 3無碼  4素人
		//tag欄位  
		//路徑
		$pathArray = [
			'1' => ['2','1','en','en/censored/fanza/'],
			'2' => ['1','1','zh','zh/censored/fanza/'],
			'3' => ['3','1','jp@jp2@jp3','jp/censored/fanza/'],

			'4' => ['3','3','jp@jp2@jp3','jp/uncensored/1/'],
			'5' => ['3','3','jp@jp2@jp3','jp/uncensored/2/'],
			'6' => ['3','3','jp@jp2@jp3','jp/uncensored/3/'],
			'7' => ['3','3','jp@jp2@jp3','jp/uncensored/4/'],
			'8' => ['3','3','jp@jp2@jp3','jp/uncensored/5/'],

			'9' => ['2','3','en','en/uncensored/1/'],
			'10' => ['2','3','en','en/uncensored/2/'],
			'11' => ['2','3','en','en/uncensored/3/'],
			'12' => ['2','3','en','en/uncensored/4/'],
			'13' => ['2','3','en','en/uncensored/5/'],
		 	'14' => ['3','2','jp@jp2@jp3','jp/censored/mgstage/'],
		];
	
	
	
		$data = [];	
		$tagData = [];
		foreach ($pathArray as $_item) {
			$fp = @fopen($filePath.$_item[3].$fileName, "r");
		//$fp = @fopen($filePath.$fileName, "r");
	
		//有找到檔案
		if($fp) {
			$collection = (new FastExcel)->import($filePath.$_item[3].$fileName);
			$video_id = Video::orderby('id', 'desc')->first()->id;
			foreach ($collection as $index => $item) {
				if( $index <= 2000000000) {
					$data[] =  [ 
								// 'id' => $video_id + ($index+1),
								'video_id'=> $item['影片ID'],
								'video_source'=>$item['影片來源'],
								'video_lang'=> $_item[0],
								'title'=> $item['影片標題'], 
								'actress'=> $item['演員'], 
								'description'=> $item['影片描述'] ,
								'video_url'=>  $item['影片連結'] ,  
								'cover_img'=> $item['影片封面'] ,  
								'thumbnail_img'=> $item['縮圖'], 
								'cate_id'=> $_item[1],
								'video_page_url'=>$item['影片頁面連結'] , 
								'dvd_id'=>  $item['番號'] ,  
								'release_date'=>  $item['發行日'] ,  
								'director'=> $item['導演'], 
								'studio'=> $item['片商'], 
								'label'=>   $item['廠牌'],  
								'series'=>  $item['系列'], 
							];
						
						try{
							$videoExists = Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]])->first();

							//該筆已經有在資料庫了
							if(!$videoExists) {
								$newVideoId = Video::insertGetId( [   //寫入video
									// 'id' => $video_id + ($index+1),
									'video_id'=> $item['影片ID'],
									'video_source'=>$item['影片來源'],
									'video_lang'=> $_item[0],
									'title'=> $item['影片標題'], 
									'actress'=> $item['演員'], 
									'description'=> $item['影片描述'] ,
									'video_url'=>  $item['影片連結'] ,  
									'cover_img'=> $item['影片封面'] ,  
									'thumbnail_img'=> $item['縮圖'], 
									'cate_id'=> $_item[1],
									'video_page_url'=>$item['影片頁面連結'] , 
									'dvd_id'=>  $item['番號'] ,  
									'release_date'=>  $item['發行日'] ,  
									'director'=> $item['導演'], 
									'studio'=> $item['片商'], 
									'label'=>   $item['廠牌'],  
									'series'=>  $item['系列'], 
								]);

								
								if($newVideoId && $item['標籤']!=''){ //標籤
									$tagArray  = explode("@", $item['標籤']);
									$colunmName  = explode("@", $_item[2]);
									foreach ($tagArray as $tagItme) {
										$video_tag = Video_tag::query();
										foreach ($colunmName as $colunm) {
											$video_tag->orWhere($colunm,'like','%'.$tagItme.'%');									 
										}
										$tag = $video_tag->first(); //第一筆
										if($tag){
											$tagData[] = ['video_id'=> $newVideoId, 'tag_id' => $tag->id];
										}
									}	 
								}
							}
							
						} catch (\Illuminate\Database\QueryException $ex) {
							 dd($ex->getMessage()); 
						}

				} else {
					break;
				}
			}
			
			}
		}
		//加入不在資料庫的  影片標籤關聯
		if($tagData){
			$_tagData = [];
			foreach ($tagData as $index => $item) {
				try{
					$_tagData[] =  $item;
					if($index % 999 == 0 || ($index == count($tagData)-1) ){
						Video_tag_relations::insert($_tagData);  
						$_tagData = [];
					}
				} catch (\Exception $e) {
					dd($e->getMessage()); 
				}
				
			
			}
			
		}
		
		return response()->json([
			'data'=> count($data),
			'tagData'=> count($tagData)
		]);
	
	}
}
	