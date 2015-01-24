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
                            <a class="active" href="{{URL::to('/panel/services')}}"><i class="fa fa-tasks fa-fw"></i> Serviços</a>
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

@if(count(DB::select('select * from services where sv_owner = ?', array(Auth::user()->id))))

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Servicos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<div class="panel panel-default">

      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>Aplicação</th>
            <th>Preço</th>
            <th>Expira a</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>

            <!-- 
                Estado dos Serviços
                        1 -> Ativo
                        2 -> Temporariamente Desativado Devido A Atraso No Pagamento
                        3 -> Em Ativação
                        0 -> Cancelado 
            -->

<!-- Serviços Em Ativação -->
@foreach (DB::select('select * from services where sv_status = ? and sv_owner = ?', array(3, Auth::user()->id)) as $sv)
          <tr class="info">
            <td>{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_name}}</td>
            <td>{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_price}}&euro;</td>
            <td>{{$sv->sv_limitedate}}</td>
            <td><span class="label label-info">Em Ativação</span></td>
          </tr>
@endforeach

<!-- Serviços Ativos -->
@foreach (DB::select('select * from services where sv_status = ? and sv_owner = ?', array(1, Auth::user()->id)) as $sv)
          <tr class="success">
            <td><a href="{{URL::to('/panel/services/' . $sv->sv_id)}}">{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_name}}</a></td>
            <td>{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_price}}&euro;</td>
            <td>{{$sv->sv_limitedate}}</td>
            <td><span class="label label-success">Em Funcionamento</span></td>
          </tr>
@endforeach

<!-- Pagamento Em Atraso -->
@foreach (DB::select('select * from services where sv_status = ? and sv_owner = ?', array(2, Auth::user()->id)) as $sv)
          <tr class="warning">
            <td><a href="{{URL::to('/panel/services/' . $sv->sv_id)}}">{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_name}}</a></td>
            <td>{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_price}}&euro;</td>
            <td>Expirado</td>
            <td><span class="label label-warning">Pagamento Em Atraso</span></td>
          </tr>
@endforeach

<!-- Serviços Cancelados-->
@foreach (DB::select('select * from services where sv_status = ? and sv_owner = ?', array(0, Auth::user()->id)) as $sv)
          <tr class="danger">
            <td>{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_name}}</td>
            <td>{{DB::table('serviceslist')->where('svl_id', '=', $sv->sv_app)->first()->svl_price}}&euro;</td>
            <td>-</td>
            <td><span class="label label-danger">Cancelado</span></td>
          </tr>
@endforeach

        </tbody>
      </table>
    </div>
@else
<center><h2>Não Têm Nenhum Serviço</h2></center>
  <div class="text-right">
    <a href="{{URL::to('/panel/store')}}">
      <button type="button" class="btn btn-lg btn-success">Loja</button>
    </a> 
  </div>
@endif
@stop