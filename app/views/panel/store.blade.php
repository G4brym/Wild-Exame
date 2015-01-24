@extends('layouts.panel')
@section('sidebar')
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{URL::to('/panel')}}"><i class="fa fa-dashboard fa-fw"></i> Painel De Controlo</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/panel/news')}}"><i class="fa fa-newspaper-o fa-fw"></i> Notícias</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/panel/services')}}"><i class="fa fa-tasks fa-fw"></i> Serviços</a>
                        </li>
                        <li>
                            <a class="active" href="{{URL::to('/panel/store')}}"><i class="fa fa-shopping-cart fa-fw"></i> Loja</a>
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

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loja</h1>
                </div>
            </div>
<?php $svl = DB::table('serviceslist')->where('svl_id', '=', 2)->first(); ?>
<a href="{{URL::to('/panel/store/' . $svl->svl_id)}}">
    <div class="col-md-13">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Serviço Em Destaque</h3>
      </div>
      <div class="panel-body">
            <div style="float:right">
                    <img alt="{{$svl->svl_name}}" width="200" height="200" src="https://dummyimage.com/150" href="{{URL::to('/panel/store' . $svl->svl_id)}}">
            </div>
        <h3>{{$svl->svl_name}} - {{$svl->svl_price}}&euro;<small>/Mês</small></h3>
        {{$svl->svl_desc}}
      </div>
    </div>
    </div>
    </a>
    <hr>

<div class="row">
@foreach (DB::select('select * from serviceslist where svl_id != ? order by svl_id desc', array(2)) as $svl)
<a href="{{URL::to('/panel/store/' . $svl->svl_id)}}">
<div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">{{$svl->svl_name}} - {{$svl->svl_price}}&euro;<small>/Mês</small></h3>
      </div>
      <div class="panel-body">
            <div style="float:right">
                    <img alt="{{$svl->svl_name}}" width="150" height="150" src="https://dummyimage.com/150" href="{{URL::to('/panel/store' . $svl->svl_id)}}">
            </div>
        {{$svl->svl_desc}}
      </div>
    </div>
</div>
</a>
@endforeach
</div>
@stop