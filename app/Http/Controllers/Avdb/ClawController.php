<?php

namespace App\Http\Controllers\Avdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Utils;
use App\Lib\User;
use App\Lib\UserDB;
use Carbon\Carbon;
use QL\QueryList;

use App\Model\ClawAvInfo;

class ClawController extends Controller {	
	
	public function index(Request $request) {
		/*
		$type = $request->input('type');
		if($type != 0 && $type != 1) {
			return;
		}
		*/
		
		
		$urlstr = 'https://jmvbt.com/serchinfo_uncensored/topicsbt/topicsbt_'; //無碼
		for ($i=1; $i<2; $i++) {
			$url1 = $urlstr . $i . '.htm';
			$this->claw($url1, 0);
			echo $i;
		}
		
		$urlstr2 = 'https://jmvbt.com/serchinfo_censored/topicsbt/topicsbt_'; //有碼
		for ($x=1; $x<2; $x++) {
			$url2 = $urlstr2 . $i . '.htm';
			$this->claw($url2, 1);
			echo $x;
		}
	}
	
	private function claw($url, $type) { //0無碼
		switch ($type) {
			case 0:
				$data = QueryList::Query($url,array(
					'title' => array('.Po_u_topic .Po_u_topic_title a','text'),
					'img' => array('.Po_u_topic .Po_u_topicCG img', 'src'),
					'idno' => array('.Po_u_topic .Po_u_topic_Date_Serial font', 'text'),
					'detialurl' => array('.Po_u_topic .Po_u_topic_title a', 'href'),
				))->data;
				break;
			
			case 1:
				$data = QueryList::Query($url,array(
					'title' => array('.Po_topic .Po_topic_title a','text'),
					'img' => array('.Po_topic .Po_topicCG img', 'src'),
					'idno' => array('.Po_topic .Po_topic_Date_Serial font', 'text'),
					'detialurl' => array('.Po_topic .Po_topic_title a', 'href'),
				))->data;
				break;
		};
		$insertdata = [];
		foreach ($data as $dd) {
			$title = $dd['title'];
			$coverimg = $dd['img'];
			$idno = explode('/', $dd['idno'])[0];
			$publishtime = trim(explode('/', $dd['idno'])[1]);
			$detailurl = $dd['detialurl'];
			
			if($publishtime == '0000-00-00') {
				$publishtime = '2017-01-01';
			}
			
			/*
			$insertdata[] = [
				'title' => $title,
				'coverimg' => $coverimg,
				'idno' => $idno,
				'publish_time' => $publishtime,
				'detailurl' => $detailurl,
				'censored' => $type
			];
			*/
			$dataarr = [
				'title' => $title,
				'coverimg' => $coverimg,
				'idno' => $idno,
				'publish_time' => $publishtime,
				'detailurl' => $detailurl,
				'censored' => $type
			];					
			//單筆
			$ret = ClawAvInfo::where('detailurl', $detailurl)->first();
			if(!$ret) { 
				\DB::table('claw_av_info')->insert($dataarr);
			}
		}
		
		//批量
		//\DB::table('claw_av_info')->insert($insertdata);
	}
	
	public function clawavdetail(Request $request) {
		
		$id = $request->input('id');
		if(!$id) {
			$avinfo = \DB::table('claw_av_info')->where('status', 0)->first();
		} else {
			$avinfo = \DB::table('claw_av_info')->where('id', $id)->first();
		}
		
		if(!$avinfo) {
			return ;
		}
		
		//var_dump($avinfo);
		if($avinfo->censored == 1) {
			$data = QueryList::Query($avinfo->detailurl,array(
				//'title' => array('.Po_u_topic .Po_u_topic_title a','text'),
				'bigimg' => array('#info .info_cg img', 'src'),
				'videolen' => array('#info .infobox:nth-child(4)', 'text', '-b'),
				'director' => array('#info .infobox:nth-child(5) a', 'text'),
				'producer' => array('#info .infobox:nth-child(6) a', 'text'),
				'publisher' => array('#info .infobox:nth-child(7) a', 'text'),
				'typestring' => array('#info .infobox:nth-child(8) a', 'text'),
				'tagstring' => array('#info .infobox:nth-child(9)', 'text', '-b'),  //str_replace('"影片類別：', '', $res);
				'avname' => array('.av_performer_name_box a', 'text'),
			))->data;
		} else {
			$data = QueryList::Query($avinfo->detailurl,array(
				//'title' => array('.Po_u_topic .Po_u_topic_title a','text'),
				'bigimg' => array('#info .info_cg img', 'src'),
				'videolen' => array('#info .infobox:nth-child(4)', 'text', '-b'),
				'producer' => array('#info .infobox:nth-child(5) a', 'text'),
				'typestring' => array('#info .infobox:nth-child(6) a', 'text'),
				'tagstring' => array('#info .infobox:nth-child(7) a', 'text'),
				'avname' => array('#info .infobox:nth-child(8)', 'text','-b'),
			))->data;			
		}
		
		$dataarr = [
			'id' => $avinfo->id,
			'title' => $avinfo->title,
			'bigimage' => @$data[0]['bigimg'],
			'publish_time' => $avinfo->publish_time,
			'idno' => $avinfo->idno,
			'video_len' => @$data[0]['videolen'],
			'director' => @$data[0]['director'],
			'publisher' => @$data[0]['publisher'],
			'producer' => @$data[0]['producer'],
			'typestring' => @$data[0]['typestring'],
			'tagstring' => @$data[0]['tagstring'],
			'avname' => @$data[0]['avname'],
			'censored' => $avinfo->censored,
		];			
		
		//var_dump($dataarr);
		\DB::table('claw_av_detail')->insert($dataarr);
		
		//更新
		\DB::table('claw_av_info')
            ->where('id', $avinfo->id)
            ->update(array('status' => 1));
	}
	
	
		public function clawjavbuzz(Request $request) {
			//$url = $request->input('url');
			
			$url = 'http://javbuz.com/movie/shino-tanaka--2113.html';
			if(!$url) {
				return ;
			}
			
			$data = QueryList::Query($url,array(
				'title' => array('.movie-detail h1','text'),
				'longtext' => array('.movie-detail .long-text', 'text'),
				'720p'=> array('.dropdown-menu li:nth-child(2) a', 'href'),
			))->data;
			
			var_dump($data);
			//curl 下載影片
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $data[0]['720p']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSLVERSION,3);
			$video = curl_exec ($ch);
			$error = curl_error($ch); 
			curl_close ($ch);
			
			$filename = date('Ymdis') . '-' . $user['USER_ID'] . '-' . 'x264';
		    $path = '/upvideo/' . date('Y') . '/' . date('m');
		    
			$disk = \Storage::disk('gcs');
			$disk->putFileAs($path, new File($video), $filename . '.mp4' , 'public');
						
			fclose($file);
			echo '上傳完成快檢查';
			//影片rename
			
			//影片上傳storage
			
			//新增發文
			
			//更新數據庫
		}

}