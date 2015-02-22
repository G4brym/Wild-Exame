<?php
Class time {

    public static function days($ptime){

	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return 'Mesmo agora';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  'ano',
	                 30 * 24 * 60 * 60  =>  'mês',
	                      24 * 60 * 60  =>  'dia',
	                           60 * 60  =>  'hora',
	                                60  =>  'minuto',
	                                 1  =>  'segundo'
	                );
	    $a_plural = array( 'ano'   => 'anos',
	                       'mês'  => 'meses',
	                       'dia'    => 'dias',
	                       'hora'   => 'horas',
	                       'minuto' => 'minutos',
	                       'segundo' => 'segundos'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' atrás';
	        }
	    }
    }

}