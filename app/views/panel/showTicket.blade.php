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
<?php $ticket = DB::table('tickets')->where('tk_id', '=', $id)->first(); ?>

@if($ticket->tk_status!=0)
<div class="pull-right">
  <div class="well well-sm">
      <button type="button" class="btn btn-danger" onclick="closeTicket()">Fechar Ticket</button> 
  </div>
</div>
<br>

<!-- Script do evento -->
<script>
function closeTicket() {
swal({
          title: "Tens a certeza?",
          text: "O problema será dado como resolvido pela staff.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sim, Fechar o Ticket!",
          closeOnConfirm: false
        },
        function(){
          var url = document.URL + '/close?confirm=1';
          window.location.href = url; 
        });
};
</script>
@endif

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-envelope-o "></i> {{$ticket->tk_title}}<br>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">

                                <li>
                                    <div class="timeline-badge success"><i class="fa fa-check"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-body">
                                            <p>{{$ticket->tk_text}}</p>
                                        </div>
                                        <div class="timeline-heading">
                                            <p><small class="text-muted">
                                                __________<br>
                                                <i class="fa fa-user"></i> {{DB::table('users')->where('id', '=', $ticket->tk_owner)->first()->username}}<br>
                                                <i class="fa fa-clock-o"></i> {{time::days(strtotime($ticket->tk_open))}}
                                            </small></p>
                                        </div>
                                    </div>
                                </li>
                                <hr>

            @foreach (DB::table('ticketsmessages')->where('tkm_tkid', '=', $id)->get() as $msg)
                @if($msg->tkm_staff==0)

                                <li>
                                    <div class="timeline-badge info"><i class="fa fa-comment-o"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-body">
                                            <p>{{$msg->tkm_text}}</p>
                                        </div>
                                        <div class="timeline-heading">
                                            <p><small class="text-muted">
                                                __________<br>
                                                <i class="fa fa-user"></i> {{DB::table('users')->where('id', '=', $msg->tkm_user)->first()->username}}<br>
                                                <i class="fa fa-clock-o"></i> {{time::days(strtotime($msg->tkm_date))}}
                                            </small></p>
                                        </div>
                                    </div>
                                </li>

                @else

                                <li class="timeline-inverted">
                                    <div class="timeline-badge info"><i class="fa fa-comment"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-body">
                                            <p>{{$msg->tkm_text}}</p>
                                        </div>
                                        <div class="timeline-heading">
                                            <p><small class="text-muted">
                                                __________<br>
                                                <i class="fa fa-user"></i> {{DB::table('users')->where('id', '=', $msg->tkm_user)->first()->username}}<br>
                                                <i class="fa fa-clock-o"></i> {{time::days(strtotime($msg->tkm_date))}}
                                            </small></p>
                                        </div>
                                    </div>
                                </li>

                @endif
            @endforeach
                @if($ticket->tk_status==0)

                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-close"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-body">
                                            <p>Ticket Fechado Pelo Utilizador</p>
                                        </div>
                                        <div class="timeline-heading">
                                            <p><small class="text-muted">
                                                __________<br>
                                                <i class="fa fa-user"></i> {{DB::table('users')->where('id', '=', $ticket->tk_owner)->first()->username}}<br>
                                                <i class="fa fa-clock-o"></i> {{time::days(strtotime($ticket->tk_close))}}
                                            </small></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                @else

                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <hr>

        {{ Form::open(array('route' => 'tkmessage', 'class'=>'form-horizontal')) }}
          <fieldset>
            <div class="form-group">
                    <div class="col-md-12">
                        <div class="text-left pull-left">
                            <label for="message" class="col-lg-2 control-label">Messagem</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                            {{ Form::textarea('message', null, array('class' => 'form-control', 'placeholder' => 'Menssagem', 'size' => '100x5', 'required' => 'required')) }}
                        </div>  
                        <div class="col-md-6">
                            {{Form::captcha()}}<br>
                            {{Form::hidden('ticketid', $id)}}
                    </div>             
                </div>

              <div class="form-group">
                  <div class="col-lg-12">
                      <div class="control-wrapper">
                        <center>
                          {{Form::submit('Enviar Menssagem', array('class'=>'btn btn-success'))}}
                         </center>
                      </div>
                  </div>
              </div>
            </fieldset>
          {{ Form::close() }}

                </div>

                @endif

<?php 
if($ticket->tk_readed==0){
DB::table('tickets')->where('tk_id', '=', $id)->update(array('tk_readed' => 1));
} ?>
@stop