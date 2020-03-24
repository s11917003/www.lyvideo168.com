<?php
namespace App\Http\Controllers\Rd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lib\Utils;
use App\Lib\User;
use App\Lib\UserDB;
use App\Model\ClawBasi;
use Carbon\Carbon;



class GetTextController extends Controller {	
	
	public function getext() {
		
		$od = opencc_open("s2twp.json"); //传入配置文件名
		//$text = opencc_convert("我鼠标哪儿去了。", $od);
		//echo $text;
		//opencc_close($od);
		
		$time = time() - rand(0, 5000000);
		$url = "http://api.budejie.com/api/api_open.php?a=list&c=data&type=29&page=2&maxtime=$time";
		$res = file_get_contents($url);
		if($res) {
			$resArray = json_decode($res, true);
			//var_dump($resArray);
			
			foreach ($resArray['list'] as $content) {
				$pid = $content['id'];
				$text = opencc_convert($content['text'], $od);
				$tag = opencc_convert($content['theme_name'], $od);
				echo $pid;
				echo '========' . '<br>';
				
				
				ClawBasi::firstOrCreate([
					'pid' => $pid, 
					'text' => $text, 
					'tag' => $tag, 
				]);

			}
		}
		opencc_close($od);
	}
	
	public function clawpost() {
		
		$data = ClawBasi::where('post', 0)->first();
		//var_dump($data);
		if($data) {
			$text = $data->text;
			$tag = $data->tag;	
			$userid = rand(42, 536);
			$postdata = http_build_query([
				        'text' => $text,
				        'tag' => 16,
				        'userId' => $userid,
				        'posttype' => 1
				    ]);
		
			$opts = ['http' => [
				        	'method'  => 'POST',
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $postdata
						]
					];
		
			$context  = stream_context_create($opts);
			$result = file_get_contents('http://www.c8c8tv.com/api/formupload', false, $context);
			
			if($result) {
				echo $result;
				$post = ClawBasi::find($data->id);
				$post->post = 1;
				$post->save();				
			}

		}
	}
}