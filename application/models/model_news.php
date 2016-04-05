<?php

class Model_News extends Model{

	public function get_data($news_id = null) {
		$data = array();
		$dbh = $this->getConnectBd();

		if ($news_id == null) {
			$sth =$dbh->query("SELECT `id`, `news_head`, `news_text`, `news_add_time`, `selected`, `news_edit_time` FROM news WHERE `is_active` = 1 ORDER by `news_add_time` DESC");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			while ($row = $sth->fetch()) {
				array_push($data, $row);
			}
			$data = $this->replaceDate($data);

		}else{
			$sth = $dbh->query("SELECT `id`, `news_head`, `news_text`,  `selected` FROM news WHERE `is_active` = 1 and `id` = ".$news_id);

			$sth->setFetchMode(PDO::FETCH_ASSOC);

			while ($row = $sth->fetch()) {
				array_push($data,$row);
			}

		}
		$dbh = null;
		return $data;
	}

	public function replaceDate($data){

		if($data != null){

			for($i=0; $i < count($data); $i++){
				$dateAdd = new DateTime($data[$i]['news_add_time']);
				$dateEdit = new DateTime($data[$i]['news_edit_time']);
				if($dateAdd != $dateEdit){
					$data[$i]['modifiedDate'] = false;
				}else{
					$data[$i]['modifiedDate'] = true;
				}
				$dateAdd = $dateAdd->format('d.m.Y');
				$dateEdit = $dateEdit->format('d.m.Y');
				$data[$i]['news_add_time'] = $dateAdd;
				$data[$i]['news_edit_time'] = $dateEdit;
			}
		}
		return $data;

	}

	public function setNews ($data){
		$dbh = $this->getConnectBd();
		$sth = $dbh->prepare("insert into news(`news_head`, `news_text`,`news_add_time`,`is_active`, `news_edit_time`)
							  VALUE ('{$data['news_head']}','{$data['news_text']}', '{$data['news_add_time']}', 1,'{$data['news_add_time']}')");
		$res = $sth->execute();
		$dbh = null;
		return $res;


		}


	public function updateNews ($data){
		$dbh = $this->getConnectBd();
		$sth = $dbh->prepare("update news set
                              `news_head` = '{$data['news_head']}',
                              `news_text` = '{$data['news_text']}',
                              `news_edit_time` = '{$data['news_edit_time']}'
                              where `id`= {$data['news_id']}");
		$res = $sth->execute();
		$dbh = null;
		return $res;
	}

	public function setSelected($data) {
		try {
			$dbh = $this->getConnectBd();

			$sth = $dbh->prepare("update news set `selected` = 0 where `is_active` = 1");
			$sth->execute();

			$sth = $dbh->prepare("update news set `selected` = 1 where `id`= ".$data);
			$sth->execute();
			$dbh = null;
		} catch (Exception $exept) {
			$info = debug_backtrace();
			file_put_contents('./logs/mysql.log', strip_tags("Функция:"
							.$info[0]['function']."\n\n".$exept->getMessage())
					."\n\n", FILE_APPEND);
			echo 'Ошибка:'.$exept->getMessage();
		}
	}

	public function deleteNews($news_id) {
		$dbh = $this->getConnectBd();
		$sth = $dbh->prepare("delete from  news where `id` = {$news_id}");
		$res = $sth->execute();
		$dbh = null;
		return $res;

	}







}