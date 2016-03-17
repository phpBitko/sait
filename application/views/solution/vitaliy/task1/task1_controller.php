<?php
if (isset($_POST) && $_POST!= null) {
	$model = new Task1_Model();
	$request = $model->reqPost($_POST);
	$nameVal = $request [0];
	$pasVal = $request [1];
}