@extends('layouts.panel')
@section('body')

<ul class="nav nav-tabs">
  <li class="active"><a aria-expanded="true" href="#options" data-toggle="tab">Opções</a></li>
  <li class=""><a aria-expanded="false" href="#especialDates" data-toggle="tab">Épocas Espeçiais De Recuperação</a></li>
  <li class=""><a aria-expanded="false" href="#tprofessor" data-toggle="tab">Importar Do TProfessor</a></li>
  <li class=""><a aria-expanded="false" href="#importEmails" data-toggle="tab">Importar Emails</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="options">
	 
	<div class="col-md12">
		<div class="well">
			{{ Form::open(array('route' => 'saveSettings', 'class'=>'form-horizontal')) }}
			  <fieldset>
				<legend>Opções</legend>
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#general" data-toggle="tab">Gerais</a></li>
					  <li><a href="#email" data-toggle="tab">Email</a></li>
					  <li><a href="#api" data-toggle="tab">API</a></li>
					</ul>
					<div id="optionstas" class="tab-content">
					  <div class="tab-pane fade active in" id="general"><br>
						  
						<div class="form-group">
						  <label for="siteName" class="col-lg-2 control-label">Nome Do site</label>
						  <div class="col-lg-4">
							{{ Form::text('siteName', settings::get("siteName"), array('class' => 'form-control', 'autofocus' => 'autofocus', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="shortSiteName" class="col-lg-2 control-label">Abreviatura Do Nome</label>
						  <div class="col-lg-4">
							{{ Form::text('shortSiteName', settings::get("shortSiteName"), array('class' => 'form-control', 'maxlength' => '20', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="adminEmail" class="col-lg-2 control-label">Email Do Admin</label>
						  <div class="col-lg-4">
							  {{ Form::email('adminEmail', settings::get("adminEmail"), array('class' => 'form-control', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="captchaStatus" class="col-lg-2 control-label">Captcha</label>
						  <div class="col-lg-10">
							<div class="checkbox">
							  <label>
								@if(settings::get("captchaStatus")==1)
								{{ Form::checkbox('captchaStatus', 1, true) }}
								@else
								{{ Form::checkbox('captchaStatus', 1, false) }}
								@endif
							  </label>
							</div>
						  </div>
						</div>
						<div class="form-group">
						  <label for="generatePassOnImport" class="col-lg-2 control-label">Gerar Password Ao Importar Utilizadores</label>
						  <div class="col-lg-10">
							<div class="checkbox">
							  <label>
								@if(settings::get("generatePassOnImport")==1)
								{{ Form::checkbox('generatePassOnImport', 1, true) }}
								@else
								{{ Form::checkbox('generatePassOnImport', 1, false) }}
								@endif
							  </label>
							</div>
						  </div>
						</div>
						  
					  </div>
					  <div class="tab-pane fade" id="email"><br>
						  
						<div class="form-group">
						  <label for="emailtype" class="col-lg-2 control-label">Tipo De Email</label>
						  <div class="col-lg-2">
							@if(settings::get("emailtype")==1)
							  {{ Form::select('emailtype', ['1' => 'SMTP', '2' => 'PHP Mail'], 1, ['class' => 'form-control']) }}
							@else
							  {{ Form::select('emailtype', ['1' => 'SMTP', '2' => 'PHP Mail'], 2, ['class' => 'form-control']) }}
							@endif
						  </div>
						</div>
						<div class="form-group">
						  <label for="smtpHostname" class="col-lg-2 control-label">SMTP hostname</label>
						  <div class="col-lg-4">
							{{ Form::text('smtpHostname', settings::get("smtpHostname"), array('class' => 'form-control', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="smtpPort" class="col-lg-2 control-label">SMTP port</label>
						  <div class="col-lg-2">
							{{ Form::number('smtpPort', settings::get("smtpPort"), array('class' => 'form-control', 'maxlength' => '5', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="smtpUsername" class="col-lg-2 control-label">SMTP username</label>
						  <div class="col-lg-4">
							{{ Form::text('smtpUsername', settings::get("smtpUsername"), array('class' => 'form-control', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="smtpPassword" class="col-lg-2 control-label">SMTP password</label>
						  <div class="col-lg-4">
							{{ Form::text('smtpPassword', settings::get("smtpPassword"), array('class' => 'form-control', 'required' => 'required')) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="encryptType" class="col-lg-2 control-label">SMTP Encriptação</label>
						  <div class="col-lg-3">
							@if(settings::get("encryptType")==1)
							  {{ Form::select('encryptType', ['0' => 'Sem Encriptação', '1' => 'Encriptação SSL', '2' => 'Encriptação TLS'], 1, ['class' => 'form-control']) }}
						 	@elseif(settings::get("encryptType")==2)
							  {{ Form::select('encryptType', ['0' => 'Sem Encriptação', '1' => 'Encriptação SSL', '2' => 'Encriptação TLS'], 2, ['class' => 'form-control']) }}
						 	@else
							  {{ Form::select('encryptType', ['0' => 'Sem Encriptação', '1' => 'Encriptação SSL', '2' => 'Encriptação TLS'], 0, ['class' => 'form-control']) }}
							@endif
							</select>
						  </div>
						</div>
						  
					  </div>
					  <div class="tab-pane fade" id="api"><br>
						  
						<div class="form-group">
						  <label for="apiStatus" class="col-lg-2 control-label">API</label>
						  <div class="col-lg-10">
							<div class="checkbox">
							  <label>
								@if(settings::get("apiStatus")==1)
								{{ Form::checkbox('apiStatus', 1, true) }}
								@else
								{{ Form::checkbox('apiStatus', 1, false) }}
								@endif
							  </label>
							</div>
						  </div>
						</div>
						<div class="form-group">
						  <label for="token" class="col-lg-2 control-label">Token</label>
						  <div class="col-lg-4">
							<input class="form-control" id="securityToken" value="{{settings::get("securityToken")}}" type="text" readonly>
						  </div>
						</div>
						<div class="form-group">
						  <div class="col-lg-10 col-lg-offset-2">
							  <button type="button" class="btn btn-warning" onclick="genToken()">Gerar Novo Token</button> 
						  </div>
						</div>
						  
					  </div>
					</div>

				<hr>
				<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2">
					{{Form::submit('Guardar', array('class'=>'btn btn-success'))}}
				  </div>
				</div>
			  </fieldset>
			{{ Form::close() }}
		</div>
	</div>
		
  </div>
 
  <div class="tab-pane fade" id="especialDates">
	  
	<div class="col-md-12">
		<div class="well">
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
					  <li><a href="#add" data-toggle="tab">Adicionar</a></li>
					</ul>
					<div id="dates" class="tab-content">
					  <div class="tab-pane fade active in" id="list"><br>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Dia</th>
                                            <th>Mês</th>
                                            <th>Ano</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$dates = especialDates::getList();
if(count($dates)){

	foreach(especialDates::getList() as $date){
		echo "<tr>";
		echo "<td>" . $date->ed_name . "</td>";
		echo "<td>" . $date->ed_day . "</td>";
		echo "<td>" . $date->ed_month . "</td>";
		echo "<td>" . $date->ed_year . "</td>";
		echo "<td> <button type=\"button\" class=\"btn pull-right btn-danger\" onclick=\"closeTicket".$date->ed_id."()\">Remover</button> </td>";
		echo "</tr>";
		echo "<!-- Script do evento -->
			<script>
			function closeTicket".$date->ed_id."() {
			swal({
					  title: \"Tens a certeza?\",
					  text: \"A Data Será Removida.\",
					  type: \"warning\",
					  showCancelButton: true,
					  confirmButtonColor: \"#DD6B55\",
					  confirmButtonText: \"Sim, Remova A data!\",
					  closeOnConfirm: false
					},
					function(){
					  var url = document.URL + \"/remove?id=".$date->ed_id."\";
					  window.location.href = url; 
					});
			};
			</script>";
	}
}

?>
                                    </tbody>
                                </table>
						  
<?php
if(!count($dates)){
	echo "<center><h4>Não existe nenhuma data especial guardada.</h4></center>";
}
?>
						  
					  </div>
						
					  <div class="tab-pane fade" id="add"><br>

			{{ Form::open(array('route' => 'addEspecialDate', 'class'=>'form-horizontal')) }}
			  <fieldset>

						<div class="form-group">
						  <label for="name" class="col-lg-2 control-label">Nome</label>
						  <div class="col-lg-4">
							{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nome que vai identificar a data')) }}
						  </div>
						</div>
				  		
				  		<br>
				  
<?php
$days = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24, 25 => 25, 26 => 26, 27 => 27, 28 => 28, 29 => 29, 30 => 30, 31 => 31);
$months = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$currentYear = calendar::getYear();
$nextYear = $currentYear + 1;
$years = array($currentYear => $currentYear, $nextYear => $nextYear);
?>
						<div class="form-group">
						  <label for="day" class="col-lg-2 control-label">Dia</label>
						  <div class="col-lg-4">
							{{ Form::select('day', $days, null, ['class' => 'form-control']) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="month" class="col-lg-2 control-label">Mês</label>
						  <div class="col-lg-4">
							{{ Form::select('month', $months, null, ['class' => 'form-control']) }}
						  </div>
						</div>
						<div class="form-group">
						  <label for="year" class="col-lg-2 control-label">Ano</label>
						  <div class="col-lg-4">
							{{ Form::select('year', $years, null, ['class' => 'form-control']) }}
						  </div>
						</div>
				  
				  <hr>
				  
				<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2">
					{{Form::submit('Adicionar', array('class'=>'btn btn-warning'))}}
				  </div>
				</div>
			  </fieldset>
			{{ Form::close() }}
						
					  </div>
						
				</div>
		</div>
	</div>
	  
  </div>

  <div class="tab-pane fade" id="tprofessor">
	  
	<div class="col-md12">
		<div class="well">
			<center>
				<img src="{{ URL::to('packages/images/default/tprofessor.png') }}" alt="TProfessor" width="400" height="70">
				<br>
				<h4>Para importar os alunos e os modulos da aplicação TProfessor, exporte uma tabela para exel parecida com a seguinte, faça isso com todas as disciplinas de todas as turmas que deseja importar.</h4>
				<br>
				<img src="{{ URL::to('packages/images/default/tprofessortable.png') }}" alt="TProfessorTable">
				<br>
				<h4>De seguida selecione uma tabela de cada vez e clique em importar.</h4>
				<br>
				{{ Form::open(array('route' => 'importTP', 'class'=>'form-signin', 'files'=> true)) }}
				
					<div class="form-group">
						  <label for="emailtype" class="col-lg-2 control-label">Início do ano letivo</label>
						  <div class="col-lg-2">
							{{ Form::select('startYear', [date("Y")-1 => date("Y")-1, date("Y") => date("Y")], date("Y")-1, ['class' => 'form-control']) }}
						  </div>
					</div>
				
					{{Form::file('exel')}}<br>
					{{Form::submit('Importar', array('class'=>'btn btn-info'))}}
				{{ Form::close() }}
			</center>
		</div>
	</div>
	  
  </div>
	
<div class="tab-pane fade" id="importEmails">
	  
	<div class="col-md12">
		<div class="well">
			<center>
				<h4>Para importar corretamente a lista de emails copie todos os números de processos para a 1 coluna de um ficheiro vazio de exel, e de seguida copie todos os emails correspondentes para a seguinte coluna.<br><small>Lembrando que a primeira linha das duas colunas é a identificação da coluna, por isso essa primeira linha não vai ser importada.</small><br></h4>
				<br>
				<img src="{{ URL::to('packages/images/default/importEmails.png') }}" alt="emailsExemple">
				<br>
				<h4>Siga o exemplo da imagem</h4>
				<br>
				{{ Form::open(array('route' => 'importEmails', 'class'=>'form-signin', 'files'=> true)) }}
					{{Form::file('exel')}}<br>
					{{Form::submit('Importar', array('class'=>'btn btn-info'))}}
				{{ Form::close() }}
			</center>
		</div>
	</div>
	  
  </div>
</div>

<!-- Script do evento -->
<script>
function genToken() {
swal({
          title: "Tens a certeza?",
          text: "Vai gerar um novo Token, O Token antigo será invalido.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sim",
          closeOnConfirm: false
        },
        function(){
          var url = document.URL + '/gen';
          window.location.href = url; 
        });
};
</script>
@stop