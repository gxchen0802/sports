<?php

class BaseController extends Controller {

	const FILE_SIZE_LIMIT = 5000000; // 5MB

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	public function uploadDocument()
	{
        if ( ! Input::hasFile('document')) return false;

        $size = Input::file('document')->getSize();

        if ($size > self::FILE_SIZE_LIMIT) return false;  

        $extension = Input::file('document')->getClientOriginalExtension();

        $new_file_name = md5(time() . mt_rand(0,1000)).'.'.$extension;

        $destinationPath = public_path().'/documents/'.date('Y-m-d');

        Input::file('document')->move($destinationPath, $new_file_name);

        return '/documents/'.date('Y-m-d').'/'.$new_file_name;
	}
}
