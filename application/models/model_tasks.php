<?php
class Model_Tasks extends Model{

	public function get_data() {
		$data = array();
		$dbh = $this->getConnectBd();
		$sth = $dbh->query("SELECT `task_num`, `task_text`, `selected`	FROM tasks");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		return $data;
	}

	public function setSelected($data) {
		try {
			if (isset($data['task_num'])) {
				$sth = $this->queryBd("update tasks set `selected` = 0");
				$sth->execute();
				$sth = $this->queryBd("update tasks set `selected` = 1
										where task_num = {$data['task_num']}");

				$sth->execute();
			}

		}catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}

	}

}