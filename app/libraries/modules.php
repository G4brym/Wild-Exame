<?php

Class modules {

    public static function newModule($year, $number, $name, $hours){

		if(modules::testModule($year, $number, $name, $hours)){
			return modules::getModule($year, $number, $name, $hours);
		} else {
			DB::table('modules')->insert(
				array('m_year' => $year, 'm_num' => $number, 'm_name' => $name, 'm_hours' => $hours)
			);
		}

    }
	
    public static function testModule($year, $number, $name, $hours){

		if(count(DB::table('modules')->where('m_year', '=', $year)->where('m_num', '=', $number)->where('m_name', '=', $name)->where('m_hours', '=', $hours)->first())){
			return true;
		} else {
			return false;
		}
		
    }
	
    public static function getModule($year, $number, $name, $hours){

		if(count(DB::table('modules')->where('m_year', '=', $year)->where('m_num', '=', $number)->where('m_name', '=', $name)->where('m_hours', '=', $hours)->first())){
			return DB::table('modules')->where('m_year', '=', $year)->where('m_num', '=', $number)->where('m_name', '=', $name)->where('m_hours', '=', $hours)->first();
		} else {
			return false;
		}
		
    }
	
    public static function getModuleId($year, $number, $name, $hours){

		if(count(DB::table('modules')->where('m_year', '=', $year)->where('m_num', '=', $number)->where('m_name', '=', $name)->where('m_hours', '=', $hours)->first())){
			return DB::table('modules')->where('m_year', '=', $year)->where('m_num', '=', $number)->where('m_name', '=', $name)->where('m_hours', '=', $hours)->first()->m_id;
		} else {
			return false;
		}
		
    }
}