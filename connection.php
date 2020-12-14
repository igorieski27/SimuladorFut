<?php
#fecha conexao
	function DBClose($link){
		@mysqli_close($link) or die (mysqli_error($link));
	}
#abre conexao
	function DBConnect(){
		$link = @mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die (mysqli_connect_error());
		mysqli_set_charset($link, 'utf8') or die(mysqli_error($link));
		return $link;
	}
?>