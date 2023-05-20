<?php 


Class Controller
{

	public function view($name, $data = array())
	{
		$filename = "app/views/".$name.".php";
		if(file_exists($filename))
		{
			foreach ($data as $key => $value) {
				$$key = $value;
			}
			require $filename;
		}else{

			$filename = "app/views/404.php";
			require $filename;
		}
	}

	public function loadModel($name)
	{
		$filename = "app/models/".ucfirst($name).".php";
		if(file_exists($filename))
		{
			require $filename;
			$model = ucfirst($name);
			$modelObj = new $model;
			return $modelObj;
		}else{

			throw new Exception("No model found named ".$name.".php");
		}
	}
}