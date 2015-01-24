<?php

class BaseController extends Controller {

	public function showIndex()
	{
		$title=settings::get("siteName");
		return View::make('index.index')->with('title', $title);
	}

}
