<?php
//Модель таблиці comment
class Model_Execution extends Model{


	/*public function __construct($arrayObj) {
		$this->nameSrv = $arrayObj['nameSrv'];
		//Если не введен IP, создается значение по умолчанию в БД
		if (isset($arrayObj['ipSrv'])) {
			$this->ipSrv = $arrayObj['ipSrv'];
		}
		$this->dateSrv = $arrayObj['dateSrv'];
	}*/


	//Получити всі дані із таблиці comment
	public function get_data() {

		$data = array();
		$dbh = $this->getConnectBd();
		$sth = $dbh->query("SELECT `task_num`, `user_id`, `comment`, `result`,`selected_task`
							FROM comment WHERE `is_active` = 1");
		$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		$data = $this->replace_user_id($data);
		$data = $this->replace_checked($data);
		$dbh = null;
		return $data;

	}
	//Перезаписати id користувачів на їх імена. Повертає той самий масив.
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
		$dbh = null;
		return $data;

	}

	//Встановити 'checked' для поля 'result' із значенням 1.
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

	//Добавити коментар. Приймає масив POST із форми.
	public function setComments($data) {
		try {
			$sth = $this->queryBd("update comment set `selected_task` = 0");
			$sth->execute();
			$sth = $this->queryBd("update comment set `comment` = '{$data['comment']}', `selected_task` = 1
									where user_id = {$data['user_id']} and task_num ={$data['task_num']}");

			$sth->execute();

		}catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}
	//Получити коментар. риймає масив POST із форми(ajax-запит).
	public function getComments($dataMessage) {
		try {
			$data = array();
			$dbh = $this->getConnectBd();
			$sth = $dbh->query("select `comment` from comment where task_num = {$dataMessage['task_num']} and
			                    user_id = {$dataMessage['user_id']}");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sth->fetch()) {
				array_push($data,$row);
			}
			//print_r($data);
			$dbh = null;
			return $data;

		}catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:".$info[0]['function']."\n\n"
							.$exept->getMessage())."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

	public function addFieldComment($task_num){
		$sth = $this->queryBd("insert into comment (`user_id`,`task_num`, `is_active`) SELECT `id`,($task_num),(1) from users");
		$sth->execute();

	}

	public function deleteFieldComment($task_num){
		$dbh  = $this->getConnectBd();
		$sth = $dbh->prepare("delete from  comment where `task_num`=$task_num");
		$res = $sth->execute();
		$dbh = null;
		return $res;

	}

}