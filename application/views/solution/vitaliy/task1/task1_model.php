<?php
class Task1_Model{
	static function reqPost($data){
		$arrayData = array();

		if($data != null){
			$name = $data['valName'];
			$pas = $data['valPassword'];
		}

		array_push($arrayData,$name);
		array_push($arrayData,$pas);

		return $arrayData;
	}
}