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
                            <a href="{{URL::to('/panel/store')}}"><i class="fa fa-shopping-cart fa-fw"></i> Loja</a>
                        </li>
                        <li>
                            <a class="active" href="{{URL::to('/panel/support')}}"><i class="fa fa-life-ring fa-fw"></i> Suporte</a>
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
                    <h1 class="page-header">Suporte</h1>
                </div>
            </div>

<ul class="nav nav-tabs">
  <li class="active"><a href="#tickets" data-toggle="tab">Tickets</a></li>
  <li><a href="#newTicket" data-toggle="tab">Novo Ticket</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="tickets">
    <!-- Inicio Da Pagina Tickets -->

        @if(count(DB::select('select * from tickets where tk_owner = ?', array(Auth::user()->id))))
            <div class="panel panel-default">

                  <!-- Table -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nº Ticket</th>
                        <th>Titulo</th>
                        <th>Criado em</th>
                        <th>Prioridade</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>

            <!-- 
                Estado do ticket
                        1 -> ativo sem respotas
                        2 -> ativo e com pelo menos 1 resposta da staff
                        0 -> fechado 
            -->

            <!-- Tickets Respondidos E Não Vistos -->
            @foreach (DB::select('select * from tickets where tk_owner = ? and tk_status = 2 and tk_readed = 0 order by tk_prio DESC', array(Auth::user()->id)) as $tk)
                      <tr class="success">
                        <td>{{$tk->tk_id}}</td>
                        <td><a href="{{URL::to('/panel/support/' . $tk->tk_id)}}">{{$tk->tk_title}}</a><small> (Nova Resposta)</small></td>
                        <td>{{$tk->tk_open}}</td>
                        <td>{{$tk->tk_prio}}</td>
                        <td><span class="label label-success">Respondido</span></td>
                      </tr>
            @endforeach

            <!-- Tickets Respondidos E Vistos -->
            @foreach (DB::select('select * from tickets where tk_owner = ? and tk_status = 2 and tk_readed = 1 order by tk_prio DESC', array(Auth::user()->id)) as $tk)
                      <tr>
                        <td>{{$tk->tk_id}}</td>
                        <td><a href="{{URL::to('/panel/support/' . $tk->tk_id)}}">{{$tk->tk_title}}</a></td>
                        <td>{{$tk->tk_open}}</td>
                        <td>{{$tk->tk_prio}}</td>
                        <td><span class="label label-success">Respondido</span></td>
                      </tr>
            @endforeach

            <!-- Tickets Não Respondidos -->
            @foreach (DB::select('select * from tickets where tk_owner = ? and tk_status = 1 order by tk_prio DESC', array(Auth::user()->id)) as $tk)
                      <tr>
                        <td>{{$tk->tk_id}}</td>
                        <td><a href="{{URL::to('/panel/support/' . $tk->tk_id)}}">{{$tk->tk_title}}</a></td>
                        <td>{{$tk->tk_open}}</td>
                        <td>{{$tk->tk_prio}}</td>
                        <td><span class="label label-warning">Em Espera</span></td>
                      </tr>
            @endforeach

            <!-- Tickets Fechados-->
            @foreach (DB::select('select * from tickets where tk_owner = ? and tk_status = 0 order by tk_prio DESC', array(Auth::user()->id)) as $tk)
                      <tr>
                        <td>{{$tk->tk_id}}</td>
                        <td><a href="{{URL::to('/panel/support/' . $tk->tk_id)}}">{{$tk->tk_title}}</a></td>
                        <td>{{$tk->tk_open}}</td>
                        <td>{{$tk->tk_prio}}</td>
                        <td><span class="label label-danger">Fechado</span></td>
                      </tr>
            @endforeach

                    </tbody>
                  </table>
                </div>
        @else
            <center><h2>Não Têm Nenhum Ticket</h2></center>
        @endif
    <!-- Fim Da Pagina Tickets -->
  </div>
  <div class="tab-pane fade" id="newTicket">
    <!-- Inicio Da Pagina newTickets -->
        <br>
        <div class="col-lg-12">
        {{ Form::open(array('route' => 'tkcreate', 'class'=>'form-horizontal')) }}
          <fieldset>
              <div class="form-group">
                <label for="title" class="col-lg-2 control-label">Titulo</label>
                  <div class="col-lg-6">
                    {{Form::text('title', '', array('placeholder' => 'Titulo', 'class'=>'form-control', 'required' => 'required'))}}<br>
                  </div>
                </div>

              <div class="form-group">
                <label for="message" class="col-lg-2 control-label">Menssagem</label>
                  <div class="col-lg-10">
                    {{ Form::textarea('message', null, array('class' => 'form-control', 'placeholder' => 'Menssagem do ticket', 'size' => '100x5', 'required' => 'required')) }}<br>
                  </div>
                </div>

              <div class="form-group">
                <label for="priority" class="col-lg-2 control-label">Prioridade</label>
                  <div class="col-lg-2">
                    {{Form::select('priority', array('1' => 'Baixa', '2' => 'Média', '3' => 'Alta'), null, array('class' => 'form-control'))}}<br><br><br>
                  </div>
                </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">Captcha</label>
                  <div class="col-lg-10">
                    {{Form::captcha()}}<br>
                  </div>
                </div><br>

              <div class="form-group">
                  <div class="col-md-12">
                      <div class="control-wrapper">
                        <div class="text-right pull-right">
                          {{Form::submit('Criar Ticket', array('class'=>'btn btn-success'))}}
                         </div>
                      </div>
                  </div>
              </div>
            </fieldset>
          {{ Form::close() }}
      </div>
    <!-- Fim Da Pagina newTickets -->
  </div>
</div>
@stop