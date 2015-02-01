<?php
class LoginController extends BaseController {

	public function showLogin()
	{
		$title=settings::get("siteName") . " Login";
		return View::make('login.login')-> with('title', $title);
	}
	public function showForgot()
	{
		$title=settings::get("siteName") . " Esquecime Da Password";
		return View::make('login.forgot')->with('title', $title);
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/login')->With('success', 'Sessão Terminada');
	}

	public function postLogin()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();
		if(settings::get("captchaStatus") == 1){
		    if(filter_var($input['user'], FILTER_VALIDATE_EMAIL)) {
				$rules = array('user' => 'required|email', 'password' => 'required', 'g-recaptcha-response' => 'required|recaptcha');
			}
			else {
				$rules = array('user' => 'required', 'password' => 'required', 'g-recaptcha-response' => 'required|recaptcha');
			}
		} else {
		    if(filter_var($input['user'], FILTER_VALIDATE_EMAIL)) {
				$rules = array('user' => 'required|email', 'password' => 'required');
			}
			else {
				$rules = array('user' => 'required', 'password' => 'required');
			}
		}
		$v = Validator::make($input, $rules);
		if($v->fails())
		{
			
			return Redirect::to('/login')->withErrors($v);
			
		} else {

			if(filter_var($input['user'], FILTER_VALIDATE_EMAIL)) {
				$credentials = array('email' => $input['user'], 'password' => $input['password']);
			}
			else {
				$credentials = array('id' => $input['user'], 'password' => $input['password']);
			}

			if(Auth::attempt($credentials))
			{

				$user = Auth::user();
				$user->lastlogin = time();
				$user->save();
				return Redirect::to('/');

			} else {

				return Redirect::to('/login')->withErrors('Login invalido');

			}
		}
	}
}