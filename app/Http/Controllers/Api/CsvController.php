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
use App\Model\Video_actress;
use App\Model\Video_actress_relations;
use App\Model\Video_rank;

use App\Model\PackageInfo;
use Exception;
use GuzzleHttp\RetryMiddleware;
// use PDO;
use Illuminate\Support\Facades\DB;
class CsvController extends Controller {
	public function geCsv(Request $request) {
		set_time_limit(0);
		// $filePath = storage_path('test.xlsx');
		$lang = ['日文'=>3,'英文'=>2,'中文'=>1,'Japanese'=>3];
		$fileName = "main.xlsx";
		$rankfileName = "rank.xlsx";
		$filePath = "../storage/";

		//分類 1 中文 2英文 3日本
		//分類  1有碼(FANZA) 2 有碼(Prestige) 3無碼  4素人
		//tag欄位  
		//路徑
		//rank => video_source
		$pathArray = [
			// '1' => ['2','1','en','en/censored/fanza/','fanza'],
			// '2' => ['1','1','zh','zh/censored/fanza/','fanza'],
			// '3' => ['3','1','jp@jp2@jp3','jp/censored/fanza/','fanza'],

			// '4' => ['3','3','jp@jp2@jp3','jp/uncensored/1/','uncensored'],
			// '5' => ['3','3','jp@jp2@jp3','jp/uncensored/2/','uncensored'],
			// '6' => ['3','3','jp@jp2@jp3','jp/uncensored/3/','uncensored'],
			// '7' => ['3','3','jp@jp2@jp3','jp/uncensored/4/','uncensored'],
			// '8' => ['3','3','jp@jp2@jp3','jp/uncensored/5/','uncensored'],

			// '9' => ['2','3','en','en/uncensored/1/','uncensored'],
			// '10' => ['2','3','en','en/uncensored/2/','uncensored'],
			// '11' => ['2','3','en','en/uncensored/3/','uncensored'],
			// '12' => ['2','3','en','en/uncensored/4/','uncensored'],
			// '13' => ['2','3','en','en/uncensored/5/','uncensored'],
		 	// '14' => ['3','2','jp@jp2@jp3','jp/censored/mgstage/','mgstage'],
			'15' => ['3','4','jp@jp2@jp3','jp/amateur/','amateur'],
		];
	
		$uncensored_code_arr = [290,6,18,292,320];
	
		$data = [];	
		$tagData = [];
		foreach ($pathArray as $pathIdx => $_item) {
			$fp = @fopen($filePath.$_item[3].$fileName, "r");
		
		//有找到檔案
		if($fp) {
			$collection = (new FastExcel)->import($filePath.$_item[3].$fileName);
			$uncensored_code = 0;
			$pathindex =  intval($pathIdx);
			if($pathindex>=4 && $pathindex<=13){
				$uncensored_code  = $uncensored_code_arr[($pathindex - 4) % 5];
			}
 
			foreach ($collection as $index => $item) {
				if( $index <= 2000000000) {
					$data[] =  [ 
								// 'id' => $video_id + ($index+1),
								'video_id'=> $item['影片ID'],
								'video_source'=>  $_item[4],
								'video_lang'=> $_item[0],
								'title'=> ''.$item['影片標題'], 
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
								'uncensored_code'=>  $uncensored_code, 
							];
						
						try{
							$videoExists = Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]])->first();

							//該筆不在資料庫了
							if(!$videoExists) {
								$newVideoId = Video::insertGetId( [   //寫入video
									// 'id' => $video_id + ($index+1),
									'video_id'=> $item['影片ID'],
									'video_source'=>  $_item[4],
									'video_lang'=> $_item[0],
									'title'=> ''.$item['影片標題'], 
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
									'uncensored_code'=>  $uncensored_code, 
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
								if($newVideoId){ 
									$actressData = [];
								
									$video = Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]])->first();
									$id = $video->id;
									$actress = $video->actress;
									if($video->actress){ 
										$actressArr = explode('@',$actress);
										foreach ($actressArr as $actressItme) {
											//DB::enableQueryLog();
											if($actressItme){ 
												$actress_id = Video_actress::where('ChineseName1', $actressItme)
												->orwhere('ChineseName2', $actressItme)
												->orwhere('ChineseName3', $actressItme)
												->orwhere('JapaneseName1', $actressItme)
												->orwhere('JapaneseName2', $actressItme)
												->orwhere('JapaneseName3', $actressItme)
												->orwhere('JapaneseName4', $actressItme)
												->orwhere('JapaneseName5', $actressItme)
												->first();

												if($actress_id) {
													$actressData[] = ['video_id'=> $id, 'actress_id' => $actress_id->id];
												}
											}	
										}
										if($actressData){
											Video_actress_relations::insert($actressData);  
										}
									}
								}
									
							} else { //已存在
								Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]])->update(['uncensored_code'=>  $uncensored_code]);

								
							}
							
						} catch (\Illuminate\Database\QueryException $ex) {
							dd($item['影片標題']); 
							 dd($ex->getMessage()); 
						}

				} else {
					dd('123'); 
					break;
				}
			}
			
			}
			$fp =null;
			$randSource = @fopen($filePath.$_item[3].$rankfileName, "r");
			$data1 =[];
			if($randSource) {

				//$QQsource[] = $filePath.$_item[3].$rankfileName;
				$collection = (new FastExcel)->import($filePath.$_item[3].$rankfileName);

			
				foreach ($collection as $index => $item) {
					$data1[] =  [ 
						// 'id' => $video_id + ($index+1),
						'video_id'=> $item['影片ID'],
						'rank'=>$item['名次'],
						'type'=> $item['排名方式'], 
						'video_lang'=> $_item[0],
						'video_source'=> $_item[4],
					];
				

				}
				$QQsource[] = count($data1);
				if(count($data1)>0)
					Video_rank::insert($data1);
			}
			$randSource =null;


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
			// '$QQsource' =>$QQsource,
			'data'=> count($data),
			'data1'=> count($data1),
			'tagData'=> count($tagData)
		]);
	
	}
}
	