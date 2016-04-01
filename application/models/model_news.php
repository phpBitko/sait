<?php

class Model_News extends Model{

	public function get_data() {
		$data = array();
		$dbh = $this->getConnectBd();
			$sth = $dbh->query("SELECT `news_head`, `news_text`, `news_add_time` FROM news WHERE `is_active` = 1 ORDER by `news_add_time` DESC");
			$sth->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $sth->fetch()) {
			array_push($data,$row);
		}
		$dbh = null;
		$data = $this->replaceDate($data);
		return $data;
	}

	public function replaceDate($data){

		if($data != null){

			for($i=0; $i < count($data); $i++){
				$date = new DateTime($data[$i]['news_add_time']);
				$date = $date->format('d.m.Y');
				$data[$i]['news_add_time'] = $date;
			}
		}

		return $data;




	}
}