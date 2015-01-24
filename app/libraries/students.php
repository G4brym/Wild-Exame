<?php

Class students {

    public static function newStudent($process, $name){

		if(!students::testStudent($process)){
			$user = new User();
			$user->id = $process;
			$user->name = $name;
			$user->save();
		
		}
    }
	
    public static function setEmail($process, $email){

		if(students::testStudent($process)){
			DB::table('users')->where('id', '=', $process)->update(array('email' => $email));
			students::definePassword($process);
		}
    }
	
    public static function definePassword($process){

		if(students::testStudent($process)){
			if(DB::table('users')->where('id', '=', $process)->first()->password==null){
			
				$code = str_random(8);
				$hash = Hash::make($code);
				//email::sendPW($process, $code);
				DB::table('users')->where('id', '=', $process)->update(array('password' => $hash));
				
			}
		}
    }
	
    public static function testStudent($process){

		if(count(DB::table('users')->where('id', '=', $process)->first())){
			return true;
		} else {
			return false;
		}
		
    }
	
    public static function getStudent($process){

		if(count(DB::table('users')->where('id', '=', $process)->first())){
			return DB::table('users')->where('id', '=', $process)->first();
		} else {
			return false;
		}
		
    }

	//informações dos modulos dos alunos
    public static function newModuleGrade($process, $modid, $grade){

		if(!students::testModuleGrade($process, $modid)){
			DB::table('usersmods')->insert(
				array('um_mod' => $modid, 'um_user' => $process, 'um_grade' => $grade)
			);
		} else {
			DB::table('usersmods')->where('um_mod', '=', $modid)->where('um_user', '=', $process)->update(array('um_grade' => $grade));
		}
    }
	
    public static function testModuleGrade($process, $modid){

		if(count(DB::table('usersmods')->where('um_mod', '=', $modid)->where('um_user', '=', $process)->first())){
			return true;
		} else {
			return false;
		}
		
    }
	
    public static function getModuleGrade($process, $modid){

		if(count(DB::table('usersmods')->where('um_mod', '=', $modid)->where('um_user', '=', $process)->first())){
			return DB::table('usersmods')->where('um_mod', '=', $modid)->where('um_user', '=', $process)->first()->um_grade;
		} else {
			return false;
		}
		
    }
}