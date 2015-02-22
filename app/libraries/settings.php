<?php

//{{settings::get("teste")}}

Class settings {

    public static function get($setting){

		$file = base_path() . "/app/config/settings.json";
		
		try {
		    $data = json_decode(file_get_contents($file),true);
		} catch (ParseException $e) {
		    printf("Can´t open the json file: %s", $e->getMessage());
		}

		return $data[$setting];

    }

    public static function set($setting, $value){

		$file = base_path() . "/app/config/settings.json";
		
		try {
		    $data = json_decode(file_get_contents($file),true);
			$data[$setting] = $value;
 
			$fh = fopen($file, 'w');
			fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
			fclose($fh);
			
		} catch (ParseException $e) {
		    printf("Can´t write in the json file: %s", $e->getMessage());
		}

    }
	
    public static function genToken (){
		
		try {
			
		    $code = str_random(30);
			settings::set("securityToken", $code);
			
		} catch (ParseException $e) {
		    printf("Can´t generate a new Token: %s", $e->getMessage());
		}

    }
	
	public static function isAPIEnabled (){
		if(settings::get("apiStatus")==1){
			return true;
		} else {
			return false;
		}
	}
}