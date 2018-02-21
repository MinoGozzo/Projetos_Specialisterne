<?php

  //include os .php relevantes - config, BancoDados,helpers/ajudantes.
  //Quaisquer variaveis de controle de exibição.

  $tem_erros = false;
  $erros_validacao = array();

  if (tem_post()) {//Se o post está definido.
    $recado = array();//Inicializa o array $recado.
//////////////////
    if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {//Se o nome está prenchido e não é string vazio.
      $recado['nome'] = $_POST['nome'];
    }
    else {
      $tem_erros = true;
      $erros_validacao['nome'] = "Favor informar o nome da pessoa a ser contactada.";
    }
//////////////////
    if (isset($_POST['nomedocontato']) && strlen($_POST['nomedocontato']) > 0) {//Se quem ligo está prenchido e não é string vazio.
      $recado['nomedocontato'] = $_POST['nomedocontato'];
    }
    else {
      $tem_erros = true;
      $erros_validacao['nomedocontato'] = "Favor informar para quem foi o contato.";
    }
//////////////////
    $recado['telefonedocontato'] = $_POST['telefonedocontato'];
//////////////////
    $recado['assunto'] = $_POST['assunto'];
/////
    $recado['outro'] = $_POST['outro'];
    if ($_POST['assunto'] == 4 && strlen($_POST['outro']) == 0) {
      $tem_erros = true;
      $erros_validacao['outro'] = "Favor informar a natureza do contato";
    }
//////////////////
    if (isset($_POST['urgente'])) {//Se o checkbox "Urgente" está selecionado
        $tarefa['urgente'] = 1;//Atribua o valor 1 para $tarefa['urgente'].
      } else {//Se não
        $tarefa['urgente'] = 0;//Atribua o valor 1 para $tarefa['urgente'].
      }
//////////////////
    if (! $tem_erros) {
      gravar_recado($conexao,$recado);//escrever a função gravar_recado/definir $conexao
      header('Location: Recados.php');
      die();
    }
  }
////
///
  if (isset($_POST['nome'])) {
    $_SESSION['lista_recados'][] $_POST['nome'];
  }

  $lista_recados = buscar_recados($conexao);//escrever a função buscar_recados.
///
  $recado = array(
    'id' => 0,
    'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',
    'nomedocontato' => (isset($_POST['nomedocontato'])) ? $_POST['nomedocontato'] : '',
    'telefonedocontato' => (isset($_POST['telefonedocontato'])) ? $_POST['telefonedocontato'] : '',
    'assunto' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : 1,
    'prioridade' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : 1,
    'urgente' => (isset($_POST['urgente'])) ? $_POST['urgente'] : ''
  );

  //incluir o que for relevante - templates e outras partes do display.
 ?>
