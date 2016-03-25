<?php

class Model_Users extends Model{

	public function get_data() {
		$data = array();
		$dbh = $this->getConnectBd();
		$sth = $dbh->query("SELECT `id`, `name`, `selected`	FROM users WHERE `is_active` = 1");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}

		return $data;
	}

	public function setSelected($data) {
		try {
			if (isset($data['user_id'])) {
				$sth = $this->queryBd("update users set `selected` = 0");
				$sth->execute();
				$sth = $this->queryBd("update users set `selected` = 1
									where id = {$data['user_id']}");

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