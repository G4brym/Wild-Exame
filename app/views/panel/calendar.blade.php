@extends('layouts.panel')
@section('head')
	{{ HTML::style(URL::to('/packages/panel/css/calendar.css')) }}
@stop
@section('body')
<?php
$dates = array(1, 2, 3, 44, 55, 66, 77, 88, 99);

echo '<h2>1 2015</h2>';
$dates = 1;
echo calendar::draw_calendar(3, 2015, $dates);
?>

@stop