<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <style>
    td {
      text-align: center;
    }
</style>
  <body>
    	<?php
    	require 'config.php';
    	require 'connection.php';
      require 'funcoes.php';
      $cont=0;
      $link = DBConnect();
      echo '<form method="post"> 
      <input type="submit" name="button1"
              value="Executar Rodada"/> 
        
      <input type="submit" name="button2" onclick="alerta()"
              value="Zerar pontuação"/> 
      </form> '; 
      if(isset($_POST['button1'])) { 
        Rodada();
      } 
      if(isset($_POST['button2'])) { 
        DBReseta();
      } 
      $times = DBRead("times");
      Tabela($times);
      DBClose($link);     
    	?>
      <script>
      function alerta() {
        alert("Pontuação zerada com sucesso!");
      }
</script>
<?php

    ?>
  </body>
</html>