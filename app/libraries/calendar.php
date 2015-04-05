<?php

Class calendar {

	public static function draw($month,$year,$dates = array()){
		
			/* draw table */
			$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

			/* table headings */
			$headings = array('Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado');
			$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

			/* days and weeks vars now ... */
			$running_day = date('w',mktime(0,0,0,$month,1,$year));
			$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
			$days_in_this_week = 1;
			$day_counter = 0;
			$dates_array = array();

			/* row for week one */
			$calendar.= '<tr class="calendar-row">';

			/* print "blank" days until the first of the current week */
			for($x = 0; $x < $running_day; $x++):
				$calendar.= '<td class="calendar-day-np"> </td>';
				$days_in_this_week++;
			endfor;

			/* keep going with days.... */
			for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		
				if(isset($dates[$list_day])) {
					$calendar.= '<td class="calendar-exameday" data-toggle="modal" data-target="#Dia'.$list_day.'">';
					/* add in the day number */
					$calendar.= '<div class="day-number">'.$list_day.'</div>';

					$calendar.= str_repeat('<p>' . $dates[$list_day] . '</p>',1);
					
				} else {
					$calendar.= '<td class="calendar-day">';
					/* add in the day number */
					$calendar.= '<div class="day-number">'.$list_day.'</div>';

					$calendar.= str_repeat('<p>' . '</p>',1);
				}

				$calendar.= '</td>';
				if($running_day == 6):
					$calendar.= '</tr>';
					if(($day_counter+1) != $days_in_month):
						$calendar.= '<tr class="calendar-row">';
					endif;
					$running_day = -1;
					$days_in_this_week = 0;
				endif;
				$days_in_this_week++; $running_day++; $day_counter++;
			endfor;

			/* finish the rest of the days in the week */
			if($days_in_this_week < 8):
				for($x = 1; $x <= (8 - $days_in_this_week); $x++):
					$calendar.= '<td class="calendar-day-np"> </td>';
				endfor;
			endif;

			/* final row */
			$calendar.= '</tr>';

			/* end the table */
			$calendar.= '</table>';

			/* all done, return result */
			return $calendar;
	}
	
    public static function getMonthName($month){

		switch ($month) {
			case 1:
				return "Janeiro";
			case 2:
				return "Fevereiro";
			case 3:
				return "Março";
			case 4:
				return "Abril";
			case 5:
				return "Maio";
			case 6:
				return "Junho";
			case 7:
				return "Julho";
			case 8:
				return "Agosto";
			case 9:
				return "Setembro";
			case 10:
				return "Outubro";
			case 11:
				return "Novembro";
			case 12:
				return "Dezembro";
			default:
				return "Erro";
		}

    }
	
    public static function getYear(){

		return date('Y');

    }
	
    public static function getMonth(){

		return date('n');

    }
}