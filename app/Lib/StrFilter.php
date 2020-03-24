<?php
namespace App\Lib;	
use App\Model\PostsFilterWord;

class StrFilter {
    //private $replaced = [];
    private $filtword = [];
    //construct
    function __construct()
    {
        $this->filtword = PostsFilterWord::all();
    }
    //replace
    public function chktext($text)
    {
        foreach($this->filtword as $word) {
            //echo $word->word . "\r\n";
            
            if(preg_match("/".$word->word."/", strtolower($text))) {
	            return false;
	            break;
                //$text = str_replace($key, $val, $text);
                //array_push($this->replaced, $val);
            }
        }
        return true;
    }	
	
}