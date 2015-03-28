@extends('layouts.panel')
@section('body')
<?php
if(count(DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_grade', '=', null)->where('um_date', '=', null)->get())) {
	$modules = DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_grade', '=', null)->where('um_date', '=', null)->get();
	foreach($modules as $module){
		$mod = DB::table('modules')->where('m_id', '=', $module->um_mod)->first();
	
		$array[$module->um_mod] = $mod->m_name;
	
		
	}
	
	foreach(especialDates::getList() as $date){
	
		$dates[$date->ed_id] = $date->ed_name;
	
	}
?>

	<div class="col-md12">
		<div class="well">
			{{ Form::open(array('route' => 'markExame', 'class'=>'form-horizontal')) }}
			  <fieldset>
				  <legend>Marcar Exames</legend>
						  
						<div class="form-group">
						  <label for="module" class="col-lg-2 control-label">Modulo</label>
						  <div class="col-lg-4">
							{{ Form::select('module', $array, 1, ['class' => 'form-control']) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="date" class="col-lg-2 control-label">Epoca Espeçial</label>
						  <div class="col-lg-4">
							{{ Form::select('date', $dates, 1, ['class' => 'form-control']) }}
						  </div>
						</div>

				<hr>
				<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2">
					{{Form::submit('Marcar', array('class'=>'btn btn-warning'))}}
				  </div>
				</div>
			  </fieldset>
			{{ Form::close() }}
		</div>
	</div>

<?php

} else {
?>
	<div class="list-group-item">
		<i class="fa fa-check fa-fw"></i> Não Tens Nenhum Modulo Em Atraso
	</div>
<?php
}
?>
@stop