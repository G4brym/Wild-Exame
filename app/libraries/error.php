<?php

Class error {

    public static function newerror($page, $errors){

		return Redirect::to(URL::to($page))->with("errors", $errors);

    }
}