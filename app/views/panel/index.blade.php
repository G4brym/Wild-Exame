@extends('layouts.panel')
@section('body')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Painel Dos Exames</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Historico
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
							<?php $modules = DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->get(); ?>
								@if(count($modules))
									@foreach ($modules as $module)
										<?php $mod = DB::table('modules')->where('m_id', '=', $module->um_mod)->first(); ?>
								
										@if($module->um_grade == null && $module->um_date == null)
											<li>
												<div class="timeline-badge primary"><i class="fa fa-exclamation"></i>
												</div>
												<div class="timeline-panel">
													<div class="timeline-heading">
														<h4 class="timeline-title">{{ DB::table('disciplines')->where('d_id', '=', $mod->m_did)->first()->d_name }}</h4>
													</div>
													<div class="timeline-body">
														<p>Esta prova ainda não têm dava marcada</p>
													</div>
												</div>
											</li>
										@elseif($module->um_grade == null && $module->um_date != null)
											<li>
												<div class="timeline-badge primary"><i class="fa fa-exclamation"></i>
												</div>
												<div class="timeline-panel">
													<div class="timeline-heading">
														<h4 class="timeline-title">{{ DB::table('disciplines')->where('d_id', '=', $mod->m_did)->first()->d_name }}</h4>
													</div>
													<div class="timeline-body">
														<p>Prova marcada para o dia xx/xx/xxxx</p>
													</div>
												</div>
											</li>
										@elseif($module->um_grade >= 9.5)
											<li class="timeline-inverted">
												<div class="timeline-badge success"><i class="fa fa-check"></i>
												</div>
												<div class="timeline-panel">
													<div class="timeline-heading">
														<h4 class="timeline-title">{{ DB::table('disciplines')->where('d_id', '=', $mod->m_did)->first()->d_name }}</h4>
													</div>
													<div class="timeline-body">
														<p>Modulo Passado com uma pontuação de {{ $module->um_grade }} valores</p>
													</div>
												</div>
											</li>
										@else
											<li class="timeline-inverted">
												<div class="timeline-badge danger"><i class="fa fa-close"></i>
												</div>
												<div class="timeline-panel">
													<div class="timeline-heading">
														<h4 class="timeline-title">{{ DB::table('disciplines')->where('d_id', '=', $mod->m_did)->first()->d_name }}</h4>
													</div>
													<div class="timeline-body">
														<p>Modulo chumbado com uma pontuação de {{ $module->um_grade }} Valores</p>
													</div>
												</div>
											</li>
										@endif
								
									@endforeach
								@else
                                <li>
                                    <div class="timeline-badge primary"><i class="fa fa-exclamation"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Informação</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Ainda Não Fizeste Nenhum Exame De Recuperação</p>
                                        </div>
                                    </div>
                                </li>
								@endif
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Exames Por Fazer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
							<?php $modules = DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_grade', '=', null)->get(); ?>
								@if(count($modules))
									@foreach ($modules as $module)
										<a href="{{ URL::to('module/' . $module->um_id) }}" class="list-group-item">
											<?php $mod = DB::table('modules')->where('m_id', '=', $module->um_mod)->first(); ?>
											<i class="fa fa-pencil fa-fw"></i> {{ $mod->m_name }}
											<span class="pull-right text-muted small"><em>{{ DB::table('disciplines')->where('d_id', '=', $mod->m_did)->first()->d_name }}</em>
											</span>
										</a>
									@endforeach
								@else
									<div class="list-group-item">
										<i class="fa fa-check fa-fw"></i> Não Tens Nenhum Modulo Em Atraso
									</div>
								@endif
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
@stop