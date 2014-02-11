<?php

/*

	You only need to include the class.
	No other edits to your PHP systems!
	Just make sure you have this class loaded as first (above anything else!)
	
	© Ramon Smit - DALTCORE/solutions
	SPO - SecurityPriorityOne - 2013

*/

class SPO{
	
	public function __construct(){
		if(!empty($_POST)){
			self::securePOST();
		}
		if(!empty($_GET)){
			self::secureGET();
		}
		if(!empty($_COOKIE)){
			self::secureCOOKIE();
		}
		if(!empty($_REQUEST)){
			self::secureREQUEST();
		}
		if(!empty($_SERVER)){
			self::secureSERVER();
		}
	}
	
	private function securePOST(){
		$input_arr = array();
		foreach ($_POST as $key => $input_arr) {
			if(is_array($input_arr)){       
				$_POST[$key] = self::addslashes_array($input_arr);
			}else{
				$_POST[$key] = self::makesave($input_arr);
			}	
		}
	}
	
	private function secureGET(){
		$input_arr = array();
		foreach ($_GET as $key => $input_arr) {
			if(is_array($input_arr)){       
				$_GET[$key] = self::addslashes_array($input_arr);
			}else{
				$_GET[$key] = self::makesave($input_arr);
			}
			
		}
	}
	
	private function secureCOOKIE(){
		$input_arr = array();
		foreach ($_COOKIE as $key => $input_arr) {
			if(is_array($input_arr)){       
				$_COOKIE[$key] = self::addslashes_array($input_arr);
			}else{
				$_COOKIE[$key] = self::makesave($input_arr);
			}   
		}
	}
	
	private function secureREQUEST(){
		$input_arr = array();
		foreach ($_REQUEST as $key => $input_arr) {
			if(is_array($input_arr)){       
				$_REQUEST[$key] = self::addslashes_array($input_arr);
			}else{
				$_REQUEST[$key] = self::makesave($input_arr);
			}   
		}
	}
	
	private function secureSERVER(){
		$input_arr = array();
		foreach ($_SERVER as $key => $input_arr) {
			if(is_array($input_arr)){       
				$_SERVER[$key] = self::addslashes_array($input_arr);
			}else{
				$_SERVER[$key] = self::makesave($input_arr);
			}   
		}
	}
	
	private function addslashes_array($input_arr){
		if(is_array($input_arr)){
			$tmp = array();
			foreach ($input_arr as $key1 => $val){
				$tmp[$key1] = self::addslashes_array($val);
			}
			return $tmp;
		}else{
			return self::makesave($input_arr);
		}
	}
	
	public function makesave($input){ 
		$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    	$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
		$output = str_replace($search, $replace, $input);
        $output = preg_replace('/[^\r\n\t\x20-\x7E\xA0-\xFF]/', '', $output); 
		return $output;
	}

	
}
$SPO = new SPO;
?>