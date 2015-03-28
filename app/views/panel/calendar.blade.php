@extends('layouts.panel')
@section('head')
	{{ HTML::style(URL::to('/packages/panel/css/calendar.css')) }}
@stop
@section('body')
<?php
$exams = DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_grade', '=', null)->where('um_date', '>', 0)->get();
var_dump($exams);
$dates = especialDates::getList();
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

echo '<h2>1 2015</h2>';
echo calendar::draw_calendar(3, 2015, $output);

for($i=1; $i<=31; $i++){ ?>
<div class="modal fade" id="Modal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Exames Para O Dia {{ $i }}</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div> 
<?php }

?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Modal1">
  Launch demo modal
</button>
@stop