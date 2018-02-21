<?php
  include 'config.php';//Incluir o arquivo config.php.
  include 'banco.php';//Incluir o arquivo banco.php.
  include 'ajudantes.php';//Incluir o arquivo ajudantes.php.

  $exibir_tabela = true;//A tabela ser mostrada.

  $tem_erros = false;//Inicializa $tem_erros com false.
  $erros_validacao = array();//Inicializa $erros_validacao com um array vazio.

  if (tem_post()) {//Se tem_post retorna true.
    $recado = array();//Inicializa o array $recado.

    if (isset($_POST['nome']) && strlen($_POST['nome']) > 0){//Se a superglobal $_POST['nome'] é definida e a definição tem comprimento (Não é um string vazio).
      $recado['nome'] = $_POST['nome'];//Armazene na posição 'nome' do array $recado o conteudo da $_POST de mesmo indice.
    }
    else //Caso contrario
    {
      $tem_erros = true;
      $erros_validacao['nome'] = 'O nome da recado é obrigatório.';
    }

    if (isset($_POST['descricao'])) {
      $recado['descricao'] = $_POST['descricao'];
    } else {
      $recado['descricao'] = '';
    }

    if (isset($_POST['prazo']) && strlen($_POST['prazo']) > 0) {

      if (validar_data($_POST['prazo'])) {
        $recado['prazo'] = traduz_data_para_banco($_POST['prazo']);
      }
      else {
        $tem_erros = true;
        $erros_validacao['prazo'] = 'Data invalida';
      }
    }
      else {
        $recado['prazo'] = '';
      }

    $recado['prioridade'] = $_POST['prioridade'];

    if (isset($_POST['concluida'])) {
      $recado['concluida'] = 1;
    } else {
      $recado['concluida'] = 0;
    }

    if (! $tem_erros) {
      gravar_recado($conexao, $recado);
      if (isset($_POST['lembrete']) && $_POST['lembrete'] == '1')
      {
        enviar_email($recado);
      }
      header('Location: recados.php');
      die();
    }
  }

  if (isset($_POST['nome'])) {
  $_SESSION['lista_recados'][] = $_POST['nome'];
  }

  $lista_recados = buscar_recados($conexao);

  $recado = array(
  'id' => 0,

  'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',

  'descricao' => (isset($_POST['descricao'])) ? $_POST['descricao'] : '',

  'prazo' => (isset($_POST['prazo'])) ? traduz_data_para_banco($_POST['prazo']) : '',

  'prioridade' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : 1,

  'concluida' => (isset($_POST['concluida'])) ? $_POST['concluida'] : ''
  );
  include "template.php";
?>
