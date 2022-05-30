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
        ini_set("memory_limit","20000M");
    	if($img_addr){
		 
			$path = 'thumbnail_img/'.$video_id.'/';
			$cover_img_router = $img_addr;
			
			if(!is_dir($path)){
				$flag = mkdir($path,0777,true);
			}
		 
	 
			//判斷是否存在 不存在則寫入
			$filename = $video_id.'-'.$lang.'-bg.jpg';
// 			$isExists = \Storage::disk('public')->exists($path.$filename);	
		    sleep(4);
			//if(!$isExists){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $img_addr);
				// 	$url =	'https://www.1pondo.tv/assets/sample/'.$video_id.'/str.jpg';
				// 	curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
			//	$html = curl_exec($ch);
				$data = curl_exec($ch);
				// $contents = file_get_contents( $img_addr);
				// file_put_contents('../storage/'.$path.$filename,	$contents);   
			
		 
				//  if((int)(800 >curl_getinfo($ch)['download_content_length'])){
				//      dd($video_id);
				//  } else {
				     	\Storage::disk('public')->put($path.$filename,$data);
        				$filename1 = $video_id.'-1-bg.jpg';
        				\Storage::disk('public')->put($path.$filename1,$data);
        				$filename2 = $video_id.'-2-bg.jpg';
        				\Storage::disk('public')->put($path.$filename2,$data);
				//  }
			
				curl_close($ch);
				
				//  if (\File::exists($path)) \File::deleteDirectory($path);
				// $contents = file_get_contents( $img_addr);
			
				// file_put_contents('../storage/'.$path.$filename,	$contents);   
			//}
			
		    $cover_img_router = '/storage/'.$path.$filename;
			return $cover_img_router ;
 
		}
		
	 
		return $img_addr;
		
    }
	public function updateAtressData(Request $request) {
		set_time_limit(0);
		ini_set("memory_limit","8196M");

		$videoRecord = Video::whereNotNull('actress')->get();
		$count = 0;
		$data = [];
		foreach ($videoRecord as $index => $item) { 
			 
				$actress_relations_count = Video_actress_relations::where('video_id', $item['id'])->get()->count();
				if($actress_relations_count == 0) { //有女優名稱卻沒在relations
					
					$actressArr = explode('@',$item['actress']);
					foreach ($actressArr as $actressItme) {
						if($actressItme){ 
							$column = '';
							if( $item['video_lang'] == 1) {
								$column ='ChineseName1';
							} else if( $item['video_lang'] == 2) {
								$column ='EnglishName1';
							} else {
								$column = 'JapaneseName1';
							}

							$actress_id   = Video_actress::where('ChineseName1', $actressItme)
														->orwhere('ChineseName2', $actressItme)
														->orwhere('ChineseName3', $actressItme)
														->orwhere('JapaneseName1', $actressItme)
														->orwhere('JapaneseName2', $actressItme)
														->orwhere('JapaneseName3', $actressItme)
														->orwhere('JapaneseName4', $actressItme)
														->orwhere('JapaneseName5', $actressItme)
														->orwhere('JapaneseName6', $actressItme)
														->orwhere('JapaneseName8', $actressItme)
														->orwhere('JapaneseName7', $actressItme)
														->orwhere('EnglishName1', $actressItme)
														->first();

							if($actress_id) { //但有抓到女優表的內容
								$newActressID = $actress_id->id;
							} else {
								$newActressID = Video_actress::insertGetId([$column  => $actressItme]);
							}
							
							Video_actress_relations::insert( ['video_id'=> $item['id'], 'actress_id' => $newActressID]);  
							$data[] = ['video_id'=> $item['id'], 'actress_id' => $newActressID,$column  => $actressItme];
						}	
					}

					$count++;
				}
		}

	}
	public function  updateTag(Request $request) {
	    set_time_limit(0);
		ini_set("memory_limit","8196M");

		// $filePath = storage_path('test.xlsx');
		//$lang = ['日文'=>3,'英文'=>2,'中文'=>1,'Japanese'=>3];
		$fileName = "main.xlsx";
		$rankfileName = "rank.xlsx";
		$filePath = "../storage/";
        $updateDataCount = [];  
        	$pathArray = [
			'1' => ['2','1','en','en/censored/fanza/','fanza'],
			'2' => ['1','1','zh@jp','zh/censored/fanza/','fanza'],
			'3' => ['3','1','jp@jp2@jp3','jp/censored/fanza/','fanza'],

			'4' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/1/','uncensored'],
			'5' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/2/','uncensored'],
			'6' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/3/','uncensored'],
			'7' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/4/','uncensored'],
			'8' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/5/','uncensored'],

			'9' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/1/','uncensored'],
			'10' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/2/','uncensored'],
			'11' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/3/','uncensored'],
			'12' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/4/','uncensored'],
			'13' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/5/','uncensored'],
		 	'14' => ['3','2','MGS - 日@MGS - 日2@MGS - 日3@MGS - 日4','jp/censored/mgstage/','mgstage'],
 			'15' => ['3','4','素人 - 日@素人 - 日2@素人 - 日3','jp/amatuer/','amatuer'],
 			
 			//補中文@MGS
			'16' => ['1','2','MGS - 日@MGS - 日2@MGS - 日3@MGS - 日4','jp/censored/mgstage/','mgstage'],
			//補中文素人
 			'17' => ['1','4','素人 - 日@素人 - 日2@素人 - 日3','jp/amatuer/','amatuer'],
 			//補英文@MGS
			'18' => ['2','2','MGS - 日@MGS - 日2@MGS - 日3@MGS - 日4','jp/censored/mgstage/','mgstage'],
 			//補中文無碼
 			'19' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/1/','uncensored'],
			'20' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/2/','uncensored'],
			'21' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/3/','uncensored'],
			'22' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/4/','uncensored'],
			'23' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/5/','uncensored'],
			//補英文素人
 			'24' => ['2','4','素人 - 日@素人 - 日2@素人 - 日3','jp/amatuer/','amatuer'],
		];
		$_lang = [1=>'zh',2=>'en',3=>'Jp'];
			foreach ($pathArray as $pathIdx => $_item) { //開啟資料夾
			    $fp = @fopen($filePath.$_item[3].$fileName, "r");
        		//有找到檔案
        		if($fp) {		 
        		    $collection = (new FastExcel)->import($filePath.$_item[3].$fileName);
        			//處理未碼的檔案 JP EN				 
        		
        			$contents = \Storage::disk('public')->get('tag.txt');
        		    foreach ($collection as $index => $item) {  //逐筆跑資料
        		        $data =  [ 
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
								'video_time'=>  isset($item['時長']) ?  $item['時長'] : ''
							];
							
							try{
						    $videoRecord = Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]]);
							$videoExists = $videoRecord->first();
							$langInx = intval($_item[0]);	
							$excelIdx = intval($pathIdx);
							//該筆不在資料庫了
						 	//已存在 檢視資料是否有差異 有差異UPDATE
								$findAmateurTag = false;
								if($item['標籤']!=''){ //標籤
									$tagArray  = explode("@", $item['標籤']);
									$colunmName  = explode("@", $_item[2]);
									
									foreach ($tagArray as $tagItme) {
										$video_tag = Video_tag::query();
										if($tagItme == 'S********l'){
											$tagItme ='School Girl';
										}
										foreach ($colunmName as $colunm) {
											$video_tag->orWhere($colunm,'like','%'.$tagItme.'%');									 
										}
										$tags = $video_tag->get(); //第一筆
										 
										if(count($tags) > 0 ){
											$__tagData =[];
											foreach ($tags as $tag) {
												$__tagData[]  = ['video_id'=>  $videoExists['id'], 'tag_id' => $tag->id];
												if( $tag->id == 93) {
													$findAmateurTag = true;
												}
											}
											if(count($__tagData) >0 ){
												$insertGetId = Video_tag_relations::insert($__tagData);  
											}
										} else {
											$recordTag =  '';
											if($excelIdx>=1 && $excelIdx <=3) {
												$recordTag = $_lang[$langInx] .' fanza '.$tagItme;
											} else if($excelIdx>=4 && $excelIdx <=13) {
												$recordTag = $_lang[$langInx] .' uncensored '.$tagItme;
											} else if($excelIdx==14) {
												$recordTag = $_lang[$langInx] .' msg '.$tagItme;
											} else if($excelIdx==15) {
												$recordTag = $_lang[$langInx] .' amatuer '.$tagItme;
											}
										    if(strpos($contents, $recordTag) === false ){
										      \Storage::disk('public')->put('tag.txt', $contents."\r\n".$recordTag);
										       $contents = \Storage::disk('public')->get('tag.txt');
										    }
										    
										}
										
									}	 
								} 
			
								if(($excelIdx==15 || $excelIdx==17 || $excelIdx== 24) && $findAmateurTag ==false) { // 素人(FC2)類別 裡所有影片加入 "Amateur" / "素人" / "素人"  標籤  93 
								  	Video_tag_relations::insert(['video_id'=>  $videoExists['id'], 'tag_id' =>93]);  
								}else if($excelIdx>=4 && $excelIdx <=13 || ($pathindex>=19 && $pathindex<=23)) {   // 無碼類別裡 所有影片加入 "Uncensored" / "無修正" / "無碼"  標籤  280
									Video_tag_relations::insert(['video_id'=>  $videoExists['id'], 'tag_id' =>280]);  
								}
							
							
						} catch (\Illuminate\Database\QueryException $ex) {
							dd($videoExists['cover_img']); 
							dd($ex->getMessage()); 
						}
        		    
        		    }
        		    fclose($fp);
        		}
    		
			}
	    
	}
	public function geCsv(Request $request) {
		set_time_limit(0);
		ini_set("memory_limit","20000M");

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
// 			'2' => ['1','1','zh@jp','zh/censored/fanza/','fanza'],
// 			'3' => ['3','1','jp@jp2@jp3','jp/censored/fanza/','fanza'],

// 			'4' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/1/','uncensored'],
// 			'5' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/2/','uncensored'],
// 			'6' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/3/','uncensored'],
			'7' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/4/','uncensored'],
// 			'8' => ['3','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/5/','uncensored'],

// 			'9' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/1/','uncensored'],
// 			'10' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/2/','uncensored'],
// 			'11' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/3/','uncensored'],
// 			'12' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/4/','uncensored'],
// 			'13' => ['2','3','無碼 - 英@無碼 - 英2@無碼 - 英3@無碼 - 英4@無碼 - 英5','en/uncensored/5/','uncensored'],
		 	// '14' => ['3','2','MGS - 日@MGS - 日2@MGS - 日3@MGS - 日4','jp/censored/mgstage/','mgstage'],
 			// '15' => ['3','4','素人 - 日@素人 - 日2@素人 - 日3','jp/amatuer/','amatuer'],
 			
 			
//  			//補中文@MGS
// 			'16' => ['1','2','MGS - 日@MGS - 日2@MGS - 日3@MGS - 日4','jp/censored/mgstage/','mgstage'],
// 			//補中文素人
//  			// '17' => ['1','4','素人 - 日@素人 - 日2@素人 - 日3','jp/amatuer/','amatuer'],
//  			//補英文@MGS
// 			'18' => ['2','2','MGS - 日@MGS - 日2@MGS - 日3@MGS - 日4','jp/censored/mgstage/','mgstage'],
			
			
//  			//補中文無碼
//  			'19' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/1/','uncensored'],
// 			'20' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/2/','uncensored'],
// 			'21' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/3/','uncensored'],
// 			'22' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/4/','uncensored'],
// 			'23' => ['1','3','uncoded-jp@無碼 - 日2@無碼 - 日3@無碼 - 日4@無碼 - 日5','jp/uncensored/5/','uncensored'],
// 			//補英文素人
//  			'24' => ['2','4','素人 - 日@素人 - 日2@素人 - 日3','jp/amatuer/','amatuer'],
		];
		$_lang = [1=>'zh',2=>'en',3=>'Jp'];
		$uncensored_code_arr = [290,6,18,292,320];
	
		$data = [];	
		$tagData = [];
		$tag_list = Video_tag::pluck('id')->toArray();
		foreach ($pathArray as $pathIdx => $_item) { //開啟資料夾
			$fp = @fopen($filePath.$_item[3].$fileName, "r");
	
		//有找到檔案
		if($fp) {		   
			$collection = (new FastExcel)->import($filePath.$_item[3].$fileName);
			//處理未碼的檔案 JP EN				 
			$uncensored_code = 0;
			$pathindex =  intval($pathIdx);		
		 
			if(($pathindex>=4 && $pathindex<=13)  || ($pathindex>=19 && $pathindex<=23)){
				$uncensored_code  = $uncensored_code_arr[($pathindex - 4) % 5];
			}		
			//處理未碼的檔案 JP EN
			// $contents = \Storage::disk('public')->get('tag.txt');
			foreach ($collection as $index => $item) {  //逐筆跑資料
				if(   $index > 1122 && $index <= 20000000 ) {
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
								'video_time'=>  isset($item['時長']) ? $item['時長'] : ''
							];
							
						try{
						    $videoRecord = Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]]);
							$videoExists = $videoRecord->first();
					
							//該筆不在資料庫了
							if(!$videoExists) {
							     $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
			                     $item['影片封面'] =  $cover;
			                     $data['cover_img'] =  $cover ;
								 $langInx = intval($_item[0]);	
								 $excelIdx = intval($pathIdx);


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
									'video_time'=>  isset($item['時長']) ? $item['時長'] : ''
								]);
								
								// $newVideoId1 = Video::insertGetId( [   //寫入video
								// 	// 'id' => $video_id + ($index+1),
								// 	'video_id'=> $item['影片ID'],
								// 	'video_source'=>  $_item[4],
								// 	'video_lang'=> 1,
								// 	'title'=> ''.$item['影片標題'], 
								// 	'actress'=> $item['演員'], 
								// 	'description'=> $item['影片描述'] ,
								// 	'video_url'=>  $item['影片連結'] ,  
								// 	'cover_img'=>'/storage/thumbnail_img/'.$item['影片ID'].'/'.$item['影片ID'].'-1-bg.jpg',   
								// 	'thumbnail_img'=> $item['縮圖'], 
								// 	'cate_id'=> $_item[1],
								// 	'video_page_url'=>$item['影片頁面連結'] , 
								// 	'dvd_id'=>  $item['番號'] ,  
								// 	'release_date'=>  $item['發行日'] ,  
								// 	'director'=> $item['導演'], 
								// 	'studio'=> $item['片商'], 
								// 	'label'=>   $item['廠牌'],  
								// 	'series'=>  $item['系列'], 
								// 	'uncensored_code'=>  $uncensored_code, 
								// 	'video_time'=>  isset($item['時長']) ? $item['時長'] : ''
								// ]);
								
								// $newVideoId2 = Video::insertGetId( [   //寫入video
								// 	// 'id' => $video_id + ($index+1),
								// 	'video_id'=> $item['影片ID'],
								// 	'video_source'=>  $_item[4],
								// 	'video_lang'=> 2,
								// 	'title'=> ''.$item['影片標題'], 
								// 	'actress'=> $item['演員'], 
								// 	'description'=> $item['影片描述'] ,
								// 	'video_url'=>  $item['影片連結'] ,  
								// 	'cover_img'=>'/storage/thumbnail_img/'.$item['影片ID'].'/'.$item['影片ID'].'-2-bg.jpg',   
								// 	'thumbnail_img'=> $item['縮圖'], 
								// 	'cate_id'=> $_item[1],
								// 	'video_page_url'=>$item['影片頁面連結'] , 
								// 	'dvd_id'=>  $item['番號'] ,  
								// 	'release_date'=>  $item['發行日'] ,  
								// 	'director'=> $item['導演'], 
								// 	'studio'=> $item['片商'], 
								// 	'label'=>   $item['廠牌'],  
								// 	'series'=>  $item['系列'], 
								// 	'uncensored_code'=>  $uncensored_code, 
								// 	'video_time'=>  isset($item['時長']) ? $item['時長'] : ''
								// ]);

								$findAmateurTag = false;
								if($item['標籤']!=''){ //標籤
									$tagArray  = explode("@", $item['標籤']);
									$colunmName  = explode("@", $_item[2]);
									
									foreach ($tagArray as $tagItme) {
										if($tagItme == 'S********l'){
											$tagItme ='School Girl';
										}
										$video_tag = Video_tag::query();
										foreach ($colunmName as $colunm) {
											$video_tag->orWhere($colunm,'like','%'.$tagItme.'%');									 
										}
										$tags = $video_tag->get(); //全部筆數
										
										if(count($tags) > 0 ){
											$__tagData =[];
											$__tagData1 =[];
											$__tagData2 =[];
											foreach ($tags as $tag) {
												$__tagData[]  = ['video_id'=>  $newVideoId, 'tag_id' => $tag->id];
												// $__tagData1[]  = ['video_id'=>  $newVideoId1, 'tag_id' => $tag->id];
												// $__tagData2[]  = ['video_id'=>  $newVideoId2, 'tag_id' => $tag->id];
												if( $tag->id == 93) {
													$findAmateurTag = true;
												}
											}
											if(count($__tagData) >0 ){
												Video_tag_relations::insert($__tagData);  
												// Video_tag_relations::insert($__tagData1);  
												// Video_tag_relations::insert($__tagData2);  
											}
										} else {
											$recordTag =  '';
											if($excelIdx>=1 && $excelIdx <=3) {
												$recordTag = $_lang[$langInx] .' fanza '.$tagItme;
											} else if($excelIdx>=4 && $excelIdx <=13) {
												$recordTag = $_lang[$langInx] .' uncensored '.$tagItme;
											} else if($excelIdx==14) {
												$recordTag = $_lang[$langInx] .' msg '.$tagItme;
											} else if($excelIdx==15) {
												$recordTag = $_lang[$langInx] .' amatuer '.$tagItme;
											}
										    // if(strpos($contents, $recordTag) === false ){
										    //   \Storage::disk('public')->put('tag.txt', $contents."\r\n".$recordTag);
										    //    $contents = \Storage::disk('public')->get('tag.txt');
										    // }
										    
										}
										
									}	 
								} 
			
								if(($excelIdx==15 || $excelIdx==17 || $excelIdx== 24) && $findAmateurTag ==false) { // 素人(FC2)類別 裡所有影片加入 "Amateur" / "素人" / "素人"  標籤  93 
								  	Video_tag_relations::insert(['video_id'=> $newVideoId, 'tag_id' =>93]);  
								//   	Video_tag_relations::insert(['video_id'=> $newVideoId1, 'tag_id' =>93]);  
								//   	Video_tag_relations::insert(['video_id'=> $newVideoId2, 'tag_id' =>93]);  
								} else if($excelIdx>=4 && $excelIdx <=13 || ($pathindex>=19 && $pathindex<=23)) {  // 無碼類別裡 所有影片加入 "Uncensored" / "無修正" / "無碼"  標籤  280
									Video_tag_relations::insert(['video_id'=> $newVideoId, 'tag_id' =>280]);  
								} 


								if($newVideoId){ 
									$actressData = [];
									$actressData1 = [];
								    $actressData2 = [];
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
												->orwhere('JapaneseName6', $actressItme)
												->orwhere('JapaneseName8', $actressItme)
												->orwhere('JapaneseName7', $actressItme)
												->orwhere('EnglishName1', $actressItme)
												->first();

												if($actress_id) {
													$actressData[] = ['video_id'=> $id, 'actress_id' => $actress_id->id];
													$actressData1[] = ['video_id'=> $id, '$newVideoId1' => $actress_id->id];
													$actressData2[] = ['video_id'=> $id, '$newVideoId2' => $actress_id->id];
												} else { //不在原先的女優表
													if( $_item[0] == 1) {
														$_column ='ChineseName1';
													} else if($_item[0] == 2) {
														$_column ='EnglishName1';
													} else {
														$_column = 'JapaneseName1';
													}
													 
													$newActressID = Video_actress::insertGetId([$_column => $actressItme]);
													Video_actress_relations::insert( ['video_id'=> $newVideoId, 'actress_id' => $newActressID]);  
													
														 
												// 	$newActressID1 = Video_actress::insertGetId(['ChineseName1' => $actressItme]);
												// 	Video_actress_relations::insert( ['video_id'=> $newVideoId1, 'actress_id' => $newActressID1]);  
													
														 
												// 	$newActressID2 = Video_actress::insertGetId(['EnglishName1' => $actressItme]);
												// 	Video_actress_relations::insert( ['video_id'=> $newVideoId2, 'actress_id' => $newActressID2]);  
													 
												}
											}	
										}
										if($actressData){
											Video_actress_relations::insert($actressData);  
								// 			Video_actress_relations::insert($actressData1);  
								// 			Video_actress_relations::insert($actressData2);  
										}
									}
								}
									
							} else { //已存在 檢視資料是否有差異 有差異UPDATE
							    $updateData =[];					  
							    $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
							    if($cover){
							          $updateDataCount[] =  $cover;
							    }
							    continue;
							    //0515
							    foreach ($data as $key => $val) {
							        if($videoExists[$key] != $val && $key != 'cover_img'){								
							            $updateData[$key] = $val;
							        }
 							    }

						
 							  //  if (!str_contains($videoExists['cover_img'],'storage/thumbnail_img')) {
 							        // $cover = $this->geCover($item['影片封面'],$item['影片ID'],$_item[0]);
 							        // $updateData['cover_img'] =  $cover ;
 							   // }
 							   if(count($updateData)>0 ){ //更新video
									$updateDataCount[] =$updateData;
									Video::where(['video_id'=> $item['影片ID'],'video_lang'=>$_item[0]])->update($updateData);

 							    }
							 
								 $tag_count = Video_tag_relations::where(['video_id'=> $videoExists['id']])->get()->count();
								 if( $tag_count == 0 ){
									if($item['標籤']!=''){ //標籤
										$tagArray  = explode("@", $item['標籤']);
										$colunmName  = explode("@", $_item[2]);
										foreach ($tagArray as $tagItme) {
											$video_tag = Video_tag::query();
											foreach ($colunmName as $colunm) {
												$video_tag->orWhere($colunm,'like','%'.$tagItme.'%');									 
											}
											$tag = $video_tag->first(); //第一筆
											if($tag){
										    if(!in_array($tag->id, $tag_list)){
    											$__tagData  = ['video_id'=>  $videoExists['id'], 'tag_id' => $tag->id];
    											$insertGetId = Video_tag_relations::insertGetId($__tagData);  
        										}
    										} else {
    										    // if(strpos($contents, $tagItme)  === false){
    										    //   \Storage::disk('public')->put('tag.txt', $contents."\r\n".$tagItme);
    										    //    $contents = \Storage::disk('public')->get('tag.txt');
    										    // }
    										    
    										}
								// 			if($tag){
								// 				$__tagData  = ['video_id'=>  $videoExists['id'], 'tag_id' => $tag->id];
								// 				Video_tag_relations::insert($__tagData);  
								// 			} else {
    				// 						    \Storag::disk('public')->put('tag.txt', $tagItme);
    				// 						}
										}	 
									}

								 }
					
							}
							
						} catch (\Illuminate\Database\QueryException $ex) {
						    
						     //	dd(!str_contains($videoExists['cover_img'],'storage/thumbnail_img')); 
						    //	dd($ex->getMessage()); 
							dd($videoExists['cover_img']); 
							dd($ex->getMessage()); 
						}

				} else {
				// 	dd('123'); 
				//	break;
				}
			}
			fclose($fp);
		}		
	
		$fp =null;



		}
// 	 dd('456'); 
// 		return;	
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
	
		return response()->json([
		    'updateDataCount' => count($updateDataCount),
			// '$QQsource' =>$QQsource,
			    'data'=> count($data),
			 'data1'=> count($data1),		 
		]);
	
	}
}
	