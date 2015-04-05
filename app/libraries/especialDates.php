<?php

Class especialDates {

    public static function getList(){

		$list = DB::table('dates')->get();

		return $list;
		
    }
	
    public static function getListMonth($month, $year){

		$list = DB::table('dates')->where('ed_month', '=', $month)->where('ed_year', '=', $year)->get();

		return $list;
		
    }
	
    public static function remove($id){

		if(especialDates::test($id)){
			DB::table('dates')->where('ed_id', $id)->delete();
		}

    }
	
    public static function add($name, $day, $month){

		DB::table('dates')->insert(array('ed_name' => $name, 'ed_day' => $day, 'ed_month' => $month));
		
    }
	
    public static function test($id){

		$date = DB::table('dates')->where('ed_id', $id)->first();
		if(count($date)){
			return true;
		} else {
			return false;
		}
		
    }
}