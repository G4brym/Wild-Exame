<?php

Class especialDates {

    public static function getList(){

		$file = base_path() . "/app/config/especialDates.json";
		
		try {
		    $data = json_decode(file_get_contents($file));
		} catch (ParseException $e) {
		    printf("Can´t open the json file: %s", $e->getMessage());
		}

		return $data->dates;
		
    }
	
    public static function remove(){

		return true;
    }
	
    public static function add(){

    }
	
    public static function test(){

    }
}