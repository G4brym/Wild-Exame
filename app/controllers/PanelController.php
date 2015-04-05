<?php

class PanelController extends BaseController {

	public function showIndex()
	{
		$title=settings::get("siteName") . " Início";
		return View::make('panel.index')->with('title', $title);
	}
	
	public function showExams()
	{
		$title=settings::get("siteName") . " Marcar Exames";
		return View::make('panel.exams')->with('title', $title);
	}
	
	public function showAPI()
	{
		return View::make('layouts.api');
	}

	public function showAdmin()
	{
		$title=settings::get("siteName") . " Admin";
		return View::make('panel.admin')->with('title', $title);
	}
	
	public function showCalendar()
	{
		$title=settings::get("siteName") . " Calendario";
		return View::make('panel.calendar')->with('title', $title);
	}
	
	public function genToken()
	{
		settings::genToken();
		return Redirect::to(URL::to('admin'))->With('success', 'Novo Token Gerado');
	}
	
	public function markExame()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();
		$rules = array('module' => 'required', 'date' => 'required');
		$v = Validator::make($input, $rules);
		if ($v->passes())
		{
			
			if(!count(DB::table('dates')->where('ed_id', '=', $input['date'])->first()) || !count(DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_mod', '=', $input['module'])->where('um_date', '=', null)->where('um_grade', '=', null)->first())){
				return Redirect::to(URL::to('exams'))->withInput()->WithErrors('Ocorreu Um Erro Com A Marcação Do Exame');
			}
			
			if(DB::table('usersmods')->where('um_user', '=', Auth::user()->id)->where('um_mod', '=', $input['module'])->update(array('um_date' => $input['date']))) {
				return Redirect::to(URL::to('exams'))->With('success', '1');
			} else {
				return Redirect::to(URL::to('exams'))->With('success', $input['module']. ' '. Auth::user()->id);
			}
			
			return Redirect::to(URL::to('exams'))->With('success', 'Exame Marcado');
			
		} else {
			return Redirect::to(URL::to('exams'))->withInput()->WithErrors($v);
		}
	}
	
	public function removeDate()
	{
		if(isset($_GET['id'])){
			especialDates::remove($_GET['id']);
			return Redirect::to(URL::to('admin'))->With('success', 'Data Removida');
		} else {
			return Redirect::to(URL::to('admin'))->WithErrors('Data Não Encontrada');
		}
	}
	
	public function saveSettings()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();
		$rules = array();
		$v = Validator::make($input, $rules);
		if ($v->passes())
		{
			
			if(strlen($input['siteName'])>0){
				settings::set("siteName", $input['siteName']);
			}
			if(strlen($input['shortSiteName'])>0){
				settings::set("shortSiteName", $input['shortSiteName']);
			}
			if(strlen($input['adminEmail'])>0){
				settings::set("adminEmail", $input['adminEmail']);
			}
			
			if(isset($input['captchaStatus'])){
				settings::set("captchaStatus", "1");
			} else {
				settings::set("captchaStatus", "0");	
			}
			
			if(isset($input['generatePassOnImport'])){
				settings::set("generatePassOnImport", "1");
			} else {
				settings::set("generatePassOnImport", "0");	
			}

			settings::set("emailtype", $input['emailtype']);
			if(strlen($input['smtpHostname'])>0){
				settings::set("smtpHostname", $input['smtpHostname']);
			}
			if(strlen($input['smtpPort'])>0){
				settings::set("smtpPort", $input['smtpPort']);
			}
			if(strlen($input['smtpUsername'])>0){
				settings::set("smtpUsername", $input['smtpUsername']);
			}
			if(strlen($input['smtpPassword'])>0){
				settings::set("smtpPassword", $input['smtpPassword']);
			}
			settings::set("encryptType", $input['encryptType']);
			
			if(isset($input['apiStatus'])){
				settings::set("apiStatus", "1");
			} else {
				settings::set("apiStatus", "0");	
			}
			
			return Redirect::to(URL::to('admin'))->With('success', 'Defenições Guardadas');
			
		} else {
			return Redirect::to(URL::to('admin'))->withInput()->WithErrors($v);
		}
	}
	
	public function addEspecialDate()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();
		$rules = array('name' => 'required', 'day' => 'required', 'month' => 'required', 'year' => 'required');
		$v = Validator::make($input, $rules);
		if ($v->passes())
		{
			
			if($input['day'] < 1 || $input['day'] > 31){
				return Redirect::to(URL::to('admin'))->withInput()->WithErrors("Os dias do mês apenas vão de 1 a 31");
			}
			
			if($input['month'] < 1 || $input['month'] > 12){
				return Redirect::to(URL::to('admin'))->withInput()->WithErrors("Os meses do ano apenas vão de 1 a 12");
			}
			
			if($input['month'] == 2 && $input['day'] > 29){
				return Redirect::to(URL::to('admin'))->withInput()->WithErrors("O mês de Fevereiro não pode ter mais que 29 dias");
			}
			
			$currentYear = calendar::getYear();
			$nextYear = $currentYear + 1;
			
			if($input['year'] < $currentYear || $input['year'] > $nextYear){
				return Redirect::to(URL::to('admin'))->withInput()->WithErrors("O ano deve ser entre ".$currentYear." e ".$nextYear);
			}
			
			especialDates::add($input['name'], $input['day'], $input['month']);
			
			return Redirect::to(URL::to('admin'))->With('success', 'Data Criada');
			
		} else {
			return Redirect::to(URL::to('admin'))->withInput()->WithErrors($v);
		}
	}
	
	public function importFromTProfessor()
	{
		//$input['startYear']
		$input = Input::all();
		$rules = array(
			'exel' => 'required' 
		);
		$v = Validator::make($input, $rules);
		if ($v->passes())
			{

			$path = Input::file('exel');

			$objPHPExcel = PHPExcel_IOFactory::load($path);
			$worksheet = $objPHPExcel->getActiveSheet();

			$worksheetTitle     = $worksheet->getTitle();
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;

			//deteta o numero de modulos
			$row = 1;
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				if($worksheet->getCellByColumnAndRow($col, $row)->getValue()==null){
					$col--;
					break;
				}
			}
			
			//retira 4 ao numero de colunas, pq nao sao modulos
			$modNumber = $col-4;

			//deteta o numero de estudantes
			$col = 1;
			for ($row = 1; $row <= $highestRow; ++ $row) {
				if($worksheet->getCellByColumnAndRow($col, $row)->getValue()==null){
					$row--;
					break;
				}
			}
			
			//retira 1 ao numero de linhas pq a primeira é o cabeçalho
			$stundentNumber = $row-1;
			
			$thisYearModulesNumbers = 0;

			//obtem todas as informações dos modulos e guarda na sql
			for ($row = $stundentNumber+5; $row <= $highestRow; ++ $row) {

				if(substr($worksheet->getCellByColumnAndRow(0, $row)->getValue(), 0, 4) <= $input['startYear']){
					modules::newModule(
						$worksheet->getCellByColumnAndRow(0, $row)->getValue(), //year
						$worksheet->getCellByColumnAndRow(1, $row)->getValue(), //number
						$worksheet->getCellByColumnAndRow(2, $row)->getValue(), //name
						$worksheet->getCellByColumnAndRow(3, $row)->getValue());//hour	
					$thisYearModulesNumbers++;
				} else {
					break;
				}

			}

			echo $thisYearModulesNumbers;
			
			//obtem todas as informações dos estudantes e guarda na sql
			//$stundentNumber+1 porcausa do cabeçalho
			for ($row = 2; $row <= $stundentNumber+1; ++ $row) {

					students::newStudent(
						$worksheet->getCellByColumnAndRow(0, $row)->getValue(), //process
						$worksheet->getCellByColumnAndRow(2, $row)->getValue());//name

			}

			//obtem todas as informações das notas dos modulos e guarda na sql
			//$stundentNumber+1 porcausa do cabeçalho
			for ($row = 2; $row <= $stundentNumber+1; ++ $row) {
				for ($col = 4; $col <= $thisYearModulesNumbers+3; ++ $col) {

					//numero de alunos + coluna do modulo atual(ja com as 4 colunas anteriores que nao tem informações do modulo) + 1 para comletar as linhas vazias
					$moduleRow = $stundentNumber+$col+1;
					$moduleId = modules::getModuleId(
								$worksheet->getCellByColumnAndRow(0, $moduleRow)->getValue(),
								$worksheet->getCellByColumnAndRow(1, $moduleRow)->getValue(),
								$worksheet->getCellByColumnAndRow(2, $moduleRow)->getValue(),
								$worksheet->getCellByColumnAndRow(3, $moduleRow)->getValue());

					if ($worksheet->getCellByColumnAndRow($col, $row)->getValue()==null){

						students::newModuleGrade(
							$worksheet->getCellByColumnAndRow(0, $row)->getValue(), 
							$moduleId,
							null);

					}
				}
			}
			
			return Redirect::to(URL::to('admin'))->With('success', 'Tabela Importada');
			
		} else {

			return Redirect::to(URL::to('admin'))->WithErrors($v);

		}
	}

	public function importEmails()
	{
		
		$input = Input::all();
		$rules = array(
			'exel' => 'required' 
		);
		$v = Validator::make($input, $rules);
		if ($v->passes())
			{

			$path = Input::file('exel');

			$objPHPExcel = PHPExcel_IOFactory::load($path);
			$worksheet = $objPHPExcel->getActiveSheet();

			$highestRow         = $worksheet->getHighestRow();

			for ($row = 2; $row <= $highestRow; ++ $row) {
				if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null and $worksheet->getCellByColumnAndRow(1, $row)->getValue()!=null){
					students::setEmail(
						$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
						$worksheet->getCellByColumnAndRow(1, $row)->getValue());
				}
			}
			
			return Redirect::to(URL::to('admin'))->With('success', 'Tabela Importada');
			
		} else {

			return Redirect::to(URL::to('admin'))->WithErrors($v);

		}
	}
}