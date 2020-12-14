 <?php
 #Essa função executa query
	function DBExecute($query){
		$link = DBConnect($query);
		$result = @mysqli_query($link, $query) or die (mysqli_error($link));
		DBCLose($link);
		return $result;
	}
#Essa função le e retorna um vetor com todos os dados do banco
	function DBRead($table, $params=null, $fields='*'){
		$params = ($params) ? "{$params}" : null;
		$query =  "SELECT {$fields} FROM {$table} {$params} ORDER BY pontos desc";
		$result = DBExecute($query);

		if(!mysqli_num_rows($result)) {
			return false;
		}else{
			while ($res = mysqli_fetch_assoc($result)){
				$data[] = $res;
			}
		}
		return $data;
		
	}
#Essa função le e e retorna só um dado do banco
	function DBReadSimples($table, $params=null, $fields='*'){
		$params = ($params) ? "{$params}" : null;
		$query =  "SELECT {$fields} FROM {$table} {$params}";
		$result = DBExecute($query);

		if(!mysqli_num_rows($result)) {
			return false;
		}else{
			$res = mysqli_fetch_assoc($result);
		return $res;
		}
		
	}
#Essa função executa a partida em si. Busca os status de ataque/defesa e os utiliza nas funções de chance gol
	function Executar($id1, $id2){
		$ata1string = DBReadSimples("times", "WHERE idTime={$id1}", "ataque" );
		$ata1 = (int)$ata1string['ataque'];
		$ata2string = DBReadSimples("times", "WHERE idTime={$id2}", "ataque" );
		$ata2 = (int)$ata2string['ataque'];
		$def1string = DBReadSimples("times", "WHERE idTime={$id1}", "defesa" );
		$def1 = (int)$def1string['defesa'];
		$def2string = DBReadSimples("times", "WHERE idTime={$id2}", "defesa" );
		$def2 = (int)$def2string['defesa'];
		$golstime1 = 0;
		$golstime2 = 0;
		$cont=0;
		if ($ata1>$def2){
			while ($cont<10){
				$array= ChanceGolMelhor($ata1,$golstime1, $id1 );
				$ata1 = $array['ata'];
				$aux = $golstime1;
				$golstime1 = $array['gol'];
				if ($aux==$golstime1){
					$array = ChanceGolPior($ata2, $golstime2, $id2);
					$ata2 = $array['ata'];
					$golstime2 = $array['gol'];
				}
				$cont=$cont+1;
			}
		}
		if ($ata2>$def1){
			while ($cont<10){
				$array= ChanceGolMelhor($ata2,$golstime2, $id2 );
				$ata2 = $array['ata'];
				$aux = $golstime1;
				$golstime2 = $array['gol'];
				if ($aux<$golstime1){
					$array = ChanceGolPior($ata1, $golstime1, $id1);
					$ata1 = $array['ata'];
					$golstime1 = $array['gol'];
				}
				$cont=$cont+1;
			}
		}
		alteraPontos($golstime1, $id1, $golstime2, $id2);

		
		$time1 = DBReadSimples("times", "WHERE idTime={$id1}", "nome" );
		$time2 = DBReadSimples("times", "WHERE idTime={$id2}", "nome" );
		return "{$time1['nome']} {$golstime1} x {$golstime2} {$time2['nome']}";
	}
#Essa função calcula e executa as chances de gol do time que possui os status superiores
	function ChanceGolMelhor($ata, $golstime, $id){
		$chance = random_int(0,100);
		if ($ata>=$chance){
			$nome= DBReadSimples("times", "WHERE idTime={$id}", "nome" );
			$aux = $golstime;
			$cgol = random_int(0,2);
			if ($cgol == 2){
				$golstime = $golstime + 1;
			}
			if ($aux<$golstime){
				#echo ' Gol do '.$nome['nome'].' | Probabilidade: '.$ata.'%<br> ';
				$ata = $ata - 20;	
			}			
		}
		$array = ["gol" => $golstime, "ata" => $ata,];
		return $array;
	}
#Essa função calcula e executa as chances de gol do time que possui os status inferiores
	function ChanceGolPior($ata, $golstime, $id){
		$chance = random_int(0,100);
		$aux = $golstime;
		if ($ata>=$chance){
			$cgol = random_int(0,2);
			if ($cgol == 2){
				$golstime = $golstime + 1;
			}
			$nome= DBReadSimples("times", "WHERE idTime={$id}", "nome" );
			if ($aux<$golstime){
				$ata = $ata - 15;	
				#echo ' Gol do '.$nome['nome'].' | Probabilidade: '.$ata.'%<br> ';
			}				
		}
		$array = [
			"gol" => $golstime,
			"ata" => $ata,
		];
		return $array;
	}
#Essa função faz a rodada acontecer.
	function Rodada(){
		



		
		$a=0;
		$b=1;
		$lista = range(1, 20);
		shuffle($lista);
		$cont=0;
		while ($cont<10){
		  $res = Executar($lista[$a], $lista[$b]);
		  $a = $a + 2;
		  $b = $b + 2;
		  echo $res.'<br>';
		  $cont = $cont+1;
		}
		
	}
#Essa função renderiza a tabela 
	function Tabela ($times){
		$cont = 1;
		echo '<table border="1" align=left > <tr> <td> rank </td> <td> nome </td> <td> pontos </td> </tr>';
		foreach ($times as $t){
		   echo ' <td>'.$cont.'</td> ';
		   echo ' <td>'.$t['nome'].'</td>';
		   echo ' <td>'.$t['pontos'].'</td>';
		   echo ' <tr>';
		   $cont=$cont+1;
		}
	}
#Essa função serve pra alterar os pontos dos times
	function alteraPontos($gol1, $id1, $gol2, $id2){
		if($gol1 > $gol2){
			DBALteraPontos(3, $id1);
			DBALteraPontos(0, $id2);
		}
		if($gol2 > $gol1){
			DBALteraPontos(3, $id2);
			DBALteraPontos(0, $id1);
		}
		if($gol1 == $gol2){
			DBALteraPontos(1, $id1);
			DBALteraPontos(1, $id2);
		}

	}
#Essa função dá update no banco pra alterar os pontos - os parametros sao os pontos e o id do time a receber os pontos
	function DBALteraPontos($values, $id){
		$query =  " UPDATE times set pontos = pontos+{$values} where idTime={$id}";
		DBExecute($query);	
	}
#Essa função reseta os pontos de todos os times	
	function DBReseta(){
		$query = " UPDATE times set pontos = 0";
		DBExecute($query);
	}
	
	function DBAlteraCampanha($values, $id){
		$query =  " UPDATE times set campanha = '{$values}' where idTime={$id}";
		DBExecute($query);	
	}

	function MontarCampanha(){
		$i = 0;
		$concat = '';
		$idint=0;
		while ($i<=20){
		$id = DBReadSimples("times", "WHERE idTime={$i}", "idTime" );
		var_dump($id);
		$idint = intval($id['idTime']);
		var_dump($idint);
		$j = 0;
		$k = 0;
		while ($j<18){
			$adversarios[$j]=$k;
			$k=$k+1;
			$j=$j+1;
		}
		shuffle($adversarios);
		$j=1;
		$iDelete1 = array_search($idint, $adversarios);
		$iDelete2 = array_search(0, $adversarios);
		unset($adversarios[$iDelete1]);
		unset($adversarios[$iDelete2]);
		while($j<=20){
			if (isset($adversarios[$j])){
				$concat= $adversarios[$j].'|'.$concat;        
			}
			$j=$j+1;
		}  
		$concat=$concat.$concat; 
		var_dump($idint);
		DBAlteraCampanha($concat, $idint);
		$concat='';
		$i=$i+1;
		}
	}
