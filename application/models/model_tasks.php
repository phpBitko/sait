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
		$dbh = null;
		return $data;
	}

	public function setSelected($data, $isActive = 1) {
		try {

			if (isset($data['task_num'])) {

				if($isActive == 1){
					$sth = $this->queryBd("update tasks set `selected` = 0 where `is_active` =".$isActive);
					$sth->execute();
					$sth = $this->queryBd("update tasks set `selected` = 1
											where (task_num = {$data['task_num']} AND  `is_active` = {$isActive})");
					$sth->execute();
				}else{
				//	echo "sfdsfds";
					$sth = $this->queryBd("update tasks set `selected` = 0 where `is_active` = {$isActive}");
					$sth->execute();
					$sth = $this->queryBd("update tasks set `selected` = 1
											where (task_num = {$data['task_num']} AND `is_active` = {$isActive})");
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

	public function setTask($data) {
		//echo "<pre>"; print_r($data); echo "</pre>";
		$dataLocal = array();
		if (isset($data['task_num']) && is_numeric($data['task_num'])) {
			$dbh = $this->getConnectBd();
			$sth =
					$dbh->query("SELECT `task_num` FROM tasks where `is_active` = 1");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sth->fetch()) {
				array_push($dataLocal, $row);
			}
			$dbh = null;
			foreach ($dataLocal as $el) {
				if ($el['task_num'] == $data['task_num']) {
					$arrayNotActive = array();
					$dbh = $this->getConnectBd();
					$sth =
							$dbh->query("SELECT `task_num` FROM tasks where `is_active` = 0");
					$sth->setFetchMode(PDO::FETCH_ASSOC);
					while ($row = $sth->fetch()) {
						array_push($arrayNotActive, $row);
					}
					$dbh = null;
					foreach ($arrayNotActive as $element) {
						if ($element['task_num'] == $data['task_num']) {

							$sth = $this->queryBd("update tasks set
												  `task_num` = '{$data['task_num']}',
												  `task_text` = '{$data['task_text']}'
						  						  where (`task_num` = {$data['task_num']}
 												  and `is_active` = 0 )");
							$sth->execute();
							$this->setSelected($data, 0);

							return 'error_num';
						}
					}

					$sth = $this->queryBd("insert into tasks(`task_num`, `task_text`,`is_active`)
										  VALUE ('{$data['task_num']}','{$data['task_text']}', 0) ");
					$sth->execute();
						//$this->setSelected($data, 0);
					return 'error_num';
				}
			}
			if(isset($data['actualCheckBox'])){
				$dbh  = $this->getConnectBd();
				$sth = $dbh->prepare("update tasks set `is_actual` = 0");
				$sth->execute();

				$sth = $dbh->prepare("insert into tasks(`task_num`, `task_text`,`is_active`,`is_actual`)
												  VALUE ('{$data['task_num']}','{$data['task_text']}', 1, 1) ");
				$sth->execute();
				$dbh = null;
				//$this->setSelected($data, 0);

			}else{

				$sth = $this->queryBd("insert into tasks(`task_num`, `task_text`,`is_active`)
											  VALUE ('{$data['task_num']}','{$data['task_text']}', 1) ");
				$sth->execute();
			}
			return 'error_none';
			//echo "<pre>"; print_r($dataLocal); echo "</pre>";
		}
	}
	public function updateTask($data){
		$dbh  = $this->getConnectBd();
		if(isset($data['actualCheckBox'])){
			$sth = $dbh->prepare("update tasks set `is_actual` = 0");
			$sth->execute();

			$sth = $dbh->prepare("update tasks set `is_actual` = 1
								  WHERE `task_num` = {$data['task_num']} and `is_active` = 1");
			$res = $sth->execute();
			$dbh = null;
			//$this->setSelected($data, 0);
		}else{
			$sth = $dbh->prepare("update tasks set `task_text` ='".$data['task_text']."' , `is_actual` = 0
   											 where `task_num` = '{$data['task_num']}'
   											 and  `is_active` = 1 ");
			$res = $sth->execute();
		}

		$dbh = null;
		return $res;
	}


	public function deleteTask($taskNum){
		$dbh  = $this->getConnectBd();
		$sth = $dbh->prepare("delete from  tasks where `task_num` = $taskNum");
		$res = $sth->execute();
		$dbh = null;
		return $res;
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
		$dbh = null;
		return $data;

	}
	public function getSelectedTaskNotActual() {
		$data = array();
		$dbh = $this->getConnectBd();
		$sth = $dbh->query("SELECT `task_text`, `task_num` FROM tasks
								WHERE (`is_active` = 0 and `selected` = 1)");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		//print_r($data);
		$dbh = null;
		return $data;

	}

}