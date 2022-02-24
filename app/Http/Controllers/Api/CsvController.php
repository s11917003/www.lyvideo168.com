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
    public function geCover(string $img_addr,string $video_id,$lang) {
    	if($img_addr){
		 
			$path = 'thumbnail_img/'.$video_id.'/';
			$cover_img_router = $img_addr;
			
			if(!is_dir($path)){
				$flag = mkdir($path,0777,true);
			}
		 
	 
			//判斷是否存在 不存在則寫入
			$filename = $video_id.'-'.$lang.'-bg.jpg';
			$isExists = \Storage::disk('public')->exists($path.$filename);	
		 
			if(!$isExists){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $img_addr);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
			//	$html = curl_exec($ch);
				$data = curl_exec($ch);
				curl_close($ch);
				 
				//$contents = file_get_contents($url);
				\Storage::disk('public')->put($path.$filename,$data);
				//file_put_contents('../storage/'.$path.$filename,	$contents);   
			}
		    $cover_img_router = '/storage/'.$path.$filename;
			return $cover_img_router ;
 
		}
		return $img_addr;
		
    }
	public function geCsv(Request $request) {
		set_time_limit(0);
		 ini_set("memory_limit","8196M");

		// $filePath = storage_path('test.xlsx');
		$lang = ['日文'=>3,'英文'=>2,'中文'=>1,'Japanese'=>3];
		$fileName = "main.xlsx";
		$rankfileName = "rank.xlsx";
		$filePath = "../storage/";
        $updateDataCount = [];  
		//分類 1 中文 2英文 3日本
		//分類  1有碼(FANZA) 2 有碼(Prestige) 3無碼  4素人
		//tag欄位  
		//路徑
		//rank => video_source
		$pathArray = [
// 			'1' => ['2','1','en','en/censored/fanza/','fanza'],
// 			'2' => ['1','1','zh','zh/censored/fanza/','fanza'],
// 			'3' => ['3','1','jp@jp2@jp3','jp/censored/fanza/','fanza'],

// 			'4' => ['3','3','jp@jp2@jp3','jp/uncensored/1/','uncensored'],
// 			'5' => ['3','3','jp@jp2@jp3','jp/uncensored/2/','uncensored'],
// 			'6' => ['3','3','jp@jp2@jp3','jp/uncensored/3/','uncensored'],
// 			'7' => ['3','3','jp@jp2@jp3','jp/uncensored/4/','uncensored'],
// 			'8' => ['3','3','jp@jp2@jp3','jp/uncensored/5/','uncensored'],

// 			'9' => ['2','3','en','en/uncensored/1/','uncensored'],
// 			'10' => ['2','3','en','en/uncensored/2/','uncensored'],
// 			'11' => ['2','3','en','en/uncensored/3/','uncensored'],
// 			'12' => ['2','3','en','en/uncensored/4/','uncensored'],
// 			'13' => ['2','3','en','en/uncensored/5/','uncensored'],
		 	// '14' => ['3','2','jp@jp2@jp3','jp/censored/mgstage/','mgstage'],
 			'15' => ['3','4','jp@jp2@jp3','jp/amatuer/','amatuer'],
		];
	
		$uncensored_code_arr = [290,6,18,292,320];
	
		$data = [];	
		$tagData = [];
		foreach ($pathArray as $pathIdx => $_item) { //開啟資料夾
			$fp = @fopen($filePath.$_item[3].$fileName, "r");
	
		//有找到檔案
		if($fp) {		   
			$collection = (new FastExcel)->import($filePath.$_item[3].$fileName);
			//處理未碼的檔案 JP EN				 
			$uncensored_code = 0;
			$pathindex =  intval($pathIdx);		
			if($pathindex>=4 && $pathindex<=13){
				$uncensored_code  = $uncensored_code_arr[($pathindex - 4) % 5];
			}		
			//處理未碼的檔案 JP EN
			foreach ($collection as $index => $item) {  //逐筆跑資料
				if( $index <= 2000000000) {
					$data =  [ 
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
						    $videoRecord = Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]]);
							$videoExists = $videoRecord->first();
					
							//該筆不在資料庫了
							if(!$videoExists) {
							     $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
			                     $item['影片封面'] =  $cover;
			                     $data['cover_img'] =   $cover ;
							 //   $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
							 //   $item['影片封面'] =$cover;
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
									//$video = $videoExists;
									$id = $newVideoId;
									$actress = $item['演員'];
									if(	$actress){ 
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
									
							} else { //已存在 檢視資料是否有差異 有差異UPDATE
							    $updateData =[];					  
							    $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
							    foreach ($data as $key => $val) {
							        if($videoExists[$key] != $val && $key != 'cover_img'){								
							            $updateData[$key] = $val;
							        }
 							    }
 							  //  if (!str_contains($videoExists['cover_img'],'storage/thumbnail_img')) {
 							        $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
 							        $updateData['cover_img'] =  $cover ;
 							   // }
 							   // if(count($updateData)>0  &&  $cover!=''){ //更新video
									$updateDataCount[] =$updateData;
									Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]])->update($updateData);
									
						 
 							   // }
							}
							
						} catch (\Illuminate\Database\QueryException $ex) {
						    
						     //	dd(!str_contains($videoExists['cover_img'],'storage/thumbnail_img')); 
						    //	dd($ex->getMessage()); 
							dd($videoExists['cover_img']); 
							dd($ex->getMessage()); 
						}

				} else {
					dd('123'); 
					break;
				}
			}
			fclose($fp);
		}		
	
		$fp =null;



		}
			return response()->json([
		    'updateDataCount' => count($updateDataCount),
			// '$QQsource' =>$QQsource,
			'data'=> count($data),
			'$cover'=> $cover ,
		 
		]);
		
		Video_rank::truncate();
		foreach ($pathArray as $pathIdx => $_item) { 
			$randSource = @fopen($filePath.$_item[3].$rankfileName, "r");
			$data1 =[];
			if($randSource) {
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
				if(count($data1)>0){
					Video_rank::insert($data1);
				}

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
		    'updateDataCount' => count($updateDataCount),
			// '$QQsource' =>$QQsource,
			'data'=> count($data),
			 'data1'=> count($data1),		 
		]);
	
	}
}
	