@extends('layouts.panel')
@section('head')
	{{ HTML::style(URL::to('/packages/panel/css/calendar.css')) }}
@stop
@section('body')
<?php
//verifica o mês e o ano

$currentYear = calendar::getYear();
$nextYear = $currentYear + 1;

if(isset($_GET["month"])){
	if($_GET["month"] < 1 || $_GET["month"] > 12){
		$month = calendar::getMonth();
	} else {
		$month = $_GET["month"];
	}
} else {
	$month = calendar::getMonth();
}

if(isset($_GET["year"])){
	if($_GET["year"] < $currentYear || $_GET["year"] > $nextYear){
		$year = calendar::getYear();
	} else {
		$year = $_GET["year"];
	}
} else {
	$year = calendar::getYear();
}

//inicia
$exams = DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_grade', '=', null)->where('um_date', '>', 0)->get();
$dates = especialDates::getListMonth($month, $year);
$output = array();

$date_number = count($dates);
for($i = 0; $i<$date_number; $i++) {
	foreach($exams as $exam) {
		if($exam->um_date == $dates[$i]->ed_id) {
			if(isset($output[$dates[$i]->ed_day])) {
				$output[$dates[$i]->ed_day] = $output[$dates[$i]->ed_day] . ",<br>" . DB::table('modules')->where('m_id', '=', $exam->um_id)->first()->m_name;
			} else {
				$output[$dates[$i]->ed_day] = DB::table('modules')->where('m_id', '=', $exam->um_id)->first()->m_name;
			}
		}
	}
}
echo '
<div class="dropdown pull-left">
    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">'.calendar::getMonthName($month).'
    <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=1&year='.$year).'">Janeiro</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=2&year='.$year).'">Fevereiro</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=3&year='.$year).'">Março</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=4&year='.$year).'">Abril</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=5&year='.$year).'">Maio</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=6&year='.$year).'">Junho</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=7&year='.$year).'">Julho</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=8&year='.$year).'">Agosto</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=9&year='.$year).'">Setembro</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=10&year='.$year).'">Outubro</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=11&year='.$year).'">Novembro</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month=12&year='.$year).'">Dezembro</a></li>
    </ul>
  </div> 
  <div class="dropdown pull-left">
    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">'.$year.'
    <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month='.$month.'&year='.$currentYear).'">'.$currentYear.'</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="'.URL::to('/calendar?month='.$month.'&year='.$nextYear).'">'.$nextYear.'</a></li>
    </ul>
  </div><br><hr>';
if($output == null) {
	echo '<span class="label label-primary">Não Tens Nenhum Exame Marcado Para Este Mês.</span><br><br>';
}
echo calendar::draw($month, $year, $output);
foreach($dates as $date){ ?>
<div class="modal fade" id="Dia{{ $date->ed_day }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Exames Para O Dia {{ $date->ed_day }} De {{ calendar::getMonthName($month) }}</h4>
      </div>
      <div class="modal-body">
		  <?php if(isset($output[$date->ed_day])){ echo $output[$date->ed_day]; } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div> 
<?php } ?>
@stop