@extends('layouts.panel')
@section('sidebar')
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{URL::to('/panel')}}"><i class="fa fa-dashboard fa-fw"></i> Painel De Controlo</a>
                        </li>
                        <li>
                            <a class="active" href="{{URL::to('/panel/news')}}"><i class="fa fa-newspaper-o fa-fw"></i> Notícias</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/panel/services')}}"><i class="fa fa-tasks fa-fw"></i> Serviços</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/panel/store')}}"><i class="fa fa-shopping-cart fa-fw"></i> Loja</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/panel/support')}}"><i class="fa fa-life-ring fa-fw"></i> Suporte</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
@stop
@section('body')
<?php $lastnew = DB::table('news')->orderBy('news_id', 'desc')->first(); ?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Novidades</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<div class="panel panel-default">

      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th>Novidade</th>
            <th>Aplicação</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody>
@foreach (DB::select('select * from news where news_id > ? order by news_id desc', array(Auth::user()->news)) as $news)
          <tr class="success">
            <td>{{$news->news_id}}</td>
            <td>{{$news->news_text}}</td>
            <td>{{$news->news_app}}</td>
            <td>{{time::days(strtotime($news->news_date))}}</td>
          </tr>
@endforeach
@foreach (DB::select('select * from news where news_id <= ? order by news_id desc', array(Auth::user()->news)) as $news)
          <tr>
            <td>{{$news->news_id}}</td>
            <td>{{$news->news_text}}</td>
            <td>{{$news->news_app}}</td>
            <td>{{time::days(strtotime($news->news_date))}}</td>
          </tr>
@endforeach
        </tbody>
      </table>
    </div>

<?php
   $user = User::find(Auth::user()->id);
   $user->news = $lastnew->news_id;
   $user->save()
?>
@stop