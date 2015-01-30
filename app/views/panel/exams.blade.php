@extends('layouts.panel')
@section('body')
<?php
$modules = DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_grade', '=', null)->get();
if(count($modules)) {
	foreach($modules as $module){
		$mod = DB::table('modules')->where('m_id', '=', $module->um_mod)->first();
	
		$array[$module->um_mod] = $mod->m_name;
	
		
	}
	var_dump($array);
	echo Form::select('moduleNumber', $array);

} else {
?>
	<div class="list-group-item">
		<i class="fa fa-check fa-fw"></i> Não Tens Nenhum Modulo Em Atraso
	</div>
<?php
}
?>
@stop