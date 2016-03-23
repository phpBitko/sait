<?php
class Model_Execution extends Model{

	private $id;
	private $taskNum;
	private $user_id;
	private $comment;
	private $result;
	private $is_active;



	/*public function __construct($arrayObj) {
		$this->nameSrv = $arrayObj['nameSrv'];
		//Если не введен IP, создается значение по умолчанию в БД
		if (isset($arrayObj['ipSrv'])) {
			$this->ipSrv = $arrayObj['ipSrv'];
		}
		$this->dateSrv = $arrayObj['dateSrv'];
	}*/

	public function get_data() {

		$data = array();
		$dbh = $this->getConnectBd();
		$sth = $dbh->query("SELECT `task_num`, `user_id`, `comment`, `result`,`selected_task`
							FROM tasks_solution WHERE `is_active` = 1");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		$data = $this->replace_user_id($data);
		$data = $this->replace_checked($data);
		return $data;

	}
	public function replace_user_id($data){
		$dbh = $this->getConnectBd();
		$sth = $dbh->query("SELECT `id`, `name`
							FROM users WHERE `is_active` = 1");
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$users = array();
		while ($row = $sth->fetch()) {
			array_push($users,$row);
		}
		foreach($data as &$el){
			foreach($users as $user){
				if ($el['user_id'] == $user['id']){
					$el['user_id']  = $user['name'];
				}

			}
		}
		return $data;

	}


	public function replace_checked($data){
		foreach($data as &$el){
			if($el['result'] == 1){
				$el['result'] = 'checked';
			}else{
				$el['result'] = '';
			}
		}
		return $data;
	}


	public function setComments($data) {
		try {
			$sth = $this->queryBd("update tasks_solution set `selected_task` = 0");
			$sth->execute();
			$sth = $this->queryBd("update tasks_solution set `comment` = '{$data['comment']}', `selected_task` = 1
									where user_id = {$data['user_id']} and task_num ={$data['task_num']}");

			$sth->execute();

		}catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

	public function getComments($dataMessage) {
		try {
			$data = array();
			$dbh = $this->getConnectBd();
			$sth = $dbh->query("select `comment` from tasks_solution where task_num = {$dataMessage['task_num']} and
			                        user_id = {$dataMessage['user_id']}");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			//var_dump($sth);
			while ($row = $sth->fetch()) {
				array_push($data,$row);
			}
			//print_r($data);
			return $data;

		}catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}






	public function getNameSrv() {
		return $this->nameSrv;
	}

	public function getIpSrv() {
		return $this->ipSrv;
	}

	public function getDateSrv() {
		return $this->dateSrv;
	}

	public function setNameSrv($nameSrv) {
		$this->nameSrv = $nameSrv;
	}

	public function setIpSrv($ipSrv) {
		$this->ipSrv = $ipSrv;
	}

	public function setDateSrv($dateSrv) {
		$this->dateSrv = $dateSrv;
	}



	//Записать в базу данных
	public function writeBd() {
		try {
			//Проверка IP
			if (!empty($this->getIpSrv()) && $this->getIpSrv() != "000.000.000.000"
					&& !filter_var($this->getIpSrv(), FILTER_VALIDATE_IP)
			) {
				return "falseIp";
			}
			//Форматировать дату
			if (!$this->dateFormat()) {
				return;
			}

			//Запись в БД если отстутствует IP
			if (!isset($this->ipSrv)) {
				$array = array($this->getNameSrv(), $this->getDateSrv());
				$sth = serverInfo::queryDb("INSERT INTO server_info(nameSrv, dateSrv) values(?,?)");
				//print_r("$sth");
				if ($sth->execute($array)) {
					echo "<script>
				$(function(){
					bootbox.alert('Інформація успішно збережена!');
					});
			</script > ";
					//ПОСТУ который выводится в форме выставляем пустое значение.
					$this->setPostNull();
				} else {
					echo "<script>
				$(function(){
					bootbox.alert('Помилка запису в базу даних!');
				});
			</script > ";
				}
			} else { //Запись в БД если есть все данные
				$array = array($this->getNameSrv(), $this->getIpSrv(), $this->getDateSrv());
				$sth = serverInfo::queryDb("INSERT INTO server_info(nameSrv, ipSrv, dateSrv) values(?, ?, ?)");
				if ($sth->execute($array)) {
					echo "<script>
				$(function(){
					bootbox.alert('Інформація успішно збережена!');
				});
			</script > ";
					//ПОСТУ который выводится в форме выставляем пустое значение.
					$this->setPostNull();
				} else {
					echo "<script>
				$(function(){
					bootbox.alert('Помилка запису в базу даних!');
				});
			</script > ";
				}
			}

		} catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

//Формирование таблицы из БД, возвращает таблицу в формате ХТМЛ
	public static function selectBd() {
		try {
			//Получаем объект PDO
			$dbh = serverInfo::connectBd();
			//Формирование запроса в БД
			$sth = $dbh->query('SELECT * FROM server_info');
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			//Счетчик для номера по порядку
			$num = 0;
			//Результирующая таблица
			$table = '';
			while ($row = $sth->fetch()) {
				$num++;
				//Форматировать дату
				$date = $row['dateSrv'];
				$dateObj = \DateTime::createFromFormat('Y-m-d', $date);
				$arrDate = explode("-", $date);
				if (!empty((int)$arrDate[0])) {
					$resDate = $dateObj->format('d.m.Y');
				}else{
					$resDate = $dateObj->format('00.00.0000');
				}

				//Формировать строки в таблице
				$table .= '<tr>
							<th width="4%"><input type="checkbox" name="id_array[]" value="'.$row['id'].'"></th>
							<th width="10%">'.(int)$num.'</th>
							<th width="08%">'.(int)$row['id'].'</th>
							<th width="35%">'.htmlspecialchars($row['nameSrv']).'</th>
							<th width="23%">'.htmlspecialchars($row['ipSrv']).'</th>
							<th >'.$resDate.'</th>
						</tr>';
			}

			return $table;
		} catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

	//Удалить записи из базы данных
	public static function deleteBd() {
		try {

			//Получаем объект PDO

			$dbh = serverInfo::connectBd();
			$idString = implode(',', $_POST['id_array']);

			//Формирование запроса в БД
			$sth = $dbh->query("DELETE FROM test.server_info WHERE server_info.id IN (".$idString.")");
			$sth->execute();

			//Формирование записи для уведомления
			if (count($_POST['id_array']) == 1) {
				echo "<script>
				$(function(){
					bootbox.alert('Поле з id: "."$idString"." успішно видалено!');
				});
			</script > ";
			} else {
				echo "<script>
				$(function(){
					bootbox.alert('Поля з id: "."$idString"." успішно видалені!');
				});
			</script > ";

			}
		} catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

	//Редактировать запись в БД. Получение записи и вывод в форму через устанку значения для переменной ПОСТ
	public static function preUpdateBd() {
		try {
			$dbh = serverInfo::connectBd();
			$sth = $dbh->query("SELECT * FROM server_info WHERE id =".$_POST['id_array'][0]." LIMIT 1");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$row = $sth->fetch();
			//Форматировать дату для вывода на экран
			$date = $row['dateSrv'];
			$arrayDate = explode("-", $date);
			$date = $arrayDate[2].".".$arrayDate[1].".".$arrayDate[0];

			//Устанавливаем значения ПОСТОВ для вывода на экран
			$_POST['ipSrv'] = $row['ipSrv'];
			$_POST['dateSrv'] = $date;
			$_POST['nameSrv'] = $row['nameSrv'];

		} catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

	//Редактировать запись в БД
	public function UpdateBd() {
		try {

			//Проверка IP
			if (!empty($this->getIpSrv()) && $this->getIpSrv() != "000.000.000.000"
					&& !filter_var($this->getIpSrv(), FILTER_VALIDATE_IP)
			) {
				return "falseIp";

			} elseif (empty($this->getIpSrv())) {
				$this->setIpSrv('000.000.000.000');
			}

			//Форматировать дату
			if (!$this->dateFormat()) {
				return;
			}

			$array = array($this->getNameSrv(), $this->getIpSrv(), $this->getDateSrv());

			$sth = serverInfo::queryDb("UPDATE server_info SET nameSrv ='".$this->getNameSrv()."',
						 dateSrv= '".$this->getDateSrv()."', ipSrv='".$this->getIpSrv()."' WHERE id =".$_SESSION['id']);

			if ($sth->execute($array)) {
				echo "<script>
				$(function(){
					bootbox.alert('Інформація успішно збережена!');
				});
			</script > ";
				//Убиваем id записи которую редактировали. ПОСТУ который выводится в форме выставляем пустое значение.
				unset($_SESSION['id']);
				$this->setPostNull();
			} else {
				echo "<script>
				$(function(){
					bootbox.alert('Помилка запису в базу даних!');
				});
			</script > ";
			}

		} catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
			unset($_SESSION['id']);
		}
	}

	//Форматировать дату для записи в БД (00.00.0000 -> 0000-00-00)
	public function dateFormat() {
		$date = $this->getDateSrv();
		$arrayDate = explode(".", $date);

		if (count($arrayDate) == 3 && ($arrayDate[0] <= 31 && $arrayDate[0] > 0)
				&& ($arrayDate[1] <= 12 && $arrayDate[1] > 0)
				&& ($arrayDate[2] > 0)
		) {
			$dateObj = \DateTime::createFromFormat('d.m.Y', $date);
			$this->setDateSrv($dateObj->format('Y-m-d'));
			return true;
		} elseif (empty($this->dateSrv)) {
			return true;
		} else {
			echo "<script>
				$(function(){
					bootbox.alert('Дата введена невірно!');
				});
			</script > ";
			return false;
		}
	}

	//ПОСТАМ присваеваем пустое значение для вывода в форму
	public function setPostNull() {
		$_POST['ipSrv'] = "";
		$_POST['dateSrv'] = "";
		$_POST['nameSrv'] = "";
	}

	//Формирование запроса к БД
	public static function  queryDb($query) {
		try {
			$dbh = serverInfo::connectBd();
			$sth = $dbh->prepare($query);

			return $sth;
		} catch (Exception $exept) {
			$exept->getMessage();
		}

	}
}