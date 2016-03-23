<?php
class Model{

	public function get_data(){

	}

	protected function getConnectBd() {
		try {
			$dbh = new PDO(Core::$DSN, Core::$USER, Core::$PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $dbh;

		} catch (PDOException $exept) {
			$info = debug_backtrace();
			file_put_contents('logs/mysql.log', strip_tags("Функция:"
							.$info[0]['function']."\n\n".$exept->getMessage())
					."\n\n", FILE_APPEND);
			echo 'Подключение не удалось: '.$exept->getMessage();
			exit();
		}
	}


	protected function  queryBd($query) {
		try {
			$dbh = $this->getConnectBd();
			$sth = $dbh->prepare($query);
			return $sth;
		} catch (Exception $exept) {
			$exept->getMessage();
		}

	}



}