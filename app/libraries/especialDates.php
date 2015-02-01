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
	
    public static function remove($id){

		$file = base_path() . "/app/config/especialDates.json";
		$dates = especialDates::getList();
		
		try {
		    $data = json_decode(file_get_contents($file),true);
			$data[$setting] = $value;
 
			foreach($dates as $date){
				if($date->id == $id){
					unset($dates[])
				}
			}
			
			$fh = fopen($file, 'w');
			fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
			fclose($fh);
			
		} catch (ParseException $e) {
		    printf("Can´t write in the json file: %s", $e->getMessage());
		}

    }
	
    public static function add(){

    }
	
    public static function test($id){

			foreach(especialDates::getList() as $date){
				if($date->id == $id){
					return true;
				}
			}
		
			return false;
		
    }
}