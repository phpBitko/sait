<?php

class Model_Tasks extends Model{

	public function get_data($numTask = null) {
		$data = array();
		$dbh = $this->getConnectBd();
		if($numTask == null){
			$sth = $dbh->query("SELECT `task_num`, `task_text`, `selected`, `is_actual`	FROM tasks WHERE `is_active` = 1");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
		}else{
			$sth = $dbh->query("SELECT `task_num`, `task_text`, `selected`,`is_actual`	FROM tasks
								WHERE (`task_num` = {$numTask} AND `is_active` = 1)");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
		}
		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		return $data;
	}

	public function setSelected($data, $isActive = 1) {
		try {

			if (isset($data['task_num'])) {

				if($isActive = 1){
					$sth = $this->queryBd("update tasks set `selected` = 0 where `is_active` = $isActive");
					$sth->execute();
					$sth = $this->queryBd("update tasks set `selected` = 1
											where (task_num = {$data['task_num']} AND  `is_active` = $isActive)");
					$sth->execute();
				}else{
					$sth = $this->queryBd("update tasks set `selected` = 0 where `is_active` = $isActive");
					$sth->execute();
					$sth = $this->queryBd("update tasks set `selected` = 1
											where (task_num = {$data['task_num']} AND  `is_active` = $isActive)");
					$sth->execute();
				}



			}

		}catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}

	}
	public function setTask($data){
		echo "<pre>"; print_r($data); echo "</pre>";
		$dataLocal = array();
		if(isset($data['task_num']) && is_numeric($data['task_num'])){
			$dbh = $this->getConnectBd();
			$sth = $dbh->query("SELECT `task_num` FROM tasks where `is_active` = 1");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sth->fetch()) {
				array_push($dataLocal,$row);
			}
			foreach($dataLocal as $el){
				if($el['task_num'] == $data['task_num']){
					$sth = $this->queryBd("insert into tasks(`task_num`, `task_text`,`is_active`) VALUE ('{$data['task_num']}','{$data['task_text']}', 0) ");
					$this->setSelected($data['task_num'], 0);
					$sth->execute();
					return 'error_num';
				}
			}




			//echo "<pre>"; print_r($dataLocal); echo "</pre>";
		 }





	/*	$sth = $this->queryBd("insert into tasks set `selected` = 0");
		$sth->execute();
		$sth = $this->queryBd("update tasks set `selected` = 1
										where task_num = {$data['task_num']}");
		$sth->execute();*/
	}



	public function getActualTask() {
		$data = array();
		$dbh = $this->getConnectBd();
			$sth = $dbh->query("SELECT `task_text` FROM tasks
								WHERE `is_actual` = 1");
			$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		return $data;

	}

}