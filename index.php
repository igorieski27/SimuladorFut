<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <link rel="stylesheet" href="style.css">
  <body>
    	<?php
    	require 'config.php';
    	require 'connection.php';
      require 'funcoes.php';
      $cont=0;
      $link = DBConnect();
      echo '
	  <form method="post"> 
	  <div class=btn-group>
      <input type="submit" name="button1"
              value="Executar Rodada" class="button"/> 
        
      <input type="submit" name="button2" onclick="alerta1()"
              value="Zerar pontuação" class="button"/> 
			  
	  <input type="submit" name="button3"
              value="Executar campeonato completo" onclick="alerta2()" class="button"/> 	  
      </form> 
	  <br> </br>'; 
      if(isset($_POST['button1'])) { 
        Rodada();
      } 
      if(isset($_POST['button2'])) { 
        DBReseta();
      } 
	  if(isset($_POST['button3'])) { 
        while ($cont<=37){
			Rodada2();
			$cont=$cont+1;
		}
		getCampeao();
      } 
	  echo "<br> </br>";
      $times = DBRead("times");
      Tabela($times);
	  TabelaCamp();
      DBClose($link);     

	  
    	?>
      <script>
      function alerta1() {
        alert("Pontuação zerada com sucesso!");
      }
	  function alerta2(){
		alert("Campeonato sendo executado, aguarde...");
	  }
</script>
<?php

    ?>
  </body>
</html>