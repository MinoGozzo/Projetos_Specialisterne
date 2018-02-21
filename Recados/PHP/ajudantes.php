<?php

/*  function traduz_data_para_banco($data)//Provavelmente DELETAVEL/ADAPTAVEL.
  {
    if ($data == "")
    {//Se a variavel está vazia.
      return "";//Retorne um string vazio.
    }
    $dados = explode('/', $data);//O array $dados é igual a cada parte do string $data separado em cada sinal de barra (/);
    if (count($dados) != 3)//Se o array $dados não tem exatamente 3 posições.
    {
      return $data;//Retorne o valor do input ($data);
    }
    $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";//O array $data_mysql é igual a $dados mas com as posições invertidas ($dados[0] = $data_mysql[2], etc).

    return $data_mysql;//Retorne $data_mysql.
  }*/
  ///////////////////////////////////////////
  /*function traduz_data_para_exibir($data)//---PROVAVELMENTE deletavel/adaptavel.
  {
    if ($data == "" OR $data == "0000-00-00") {//Se data for um valor vazio ou a sequencia de zeros descrita.
      return "";//Retorne string vazio.
    }

    $dados = explode("-",$data);//Array $dados é igual ao string $data separado pelos hífens(-).

    if (count($dados) != 3) {//Se o array $dados não tem exatamente 3 posições.
      return $data;//Retorne o valor do input ($data).
    }
    $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";//O array $data_exibir é igual a $dados mas com as posições invertidas ($dados[0] = $data_exibir[2], etc).

    return $data_exibir;//Retorna $data_exibir;
  }*/
  ////////////////////////////
  function traduz_assunto($codigo)//Define a função traduz_assunto. REVISAR O QUE É DEFINIDO COMO $assunto EM CADA CASO.
  {
    $assunto = '';//Iguala a variavel $assunto como ''.

    switch ($codigo) {//Inicia o switch dependendo do valor de $codigo.
      case 1:
        $assunto = 'Cliente';//Muda o valor de $assunto para 'Cliente'.
        break;

      case 2:
        $assunto = 'Candidato';//Muda o valor de $assunto para 'Candidato'.
        break;

      case 3:
        $assunto = 'Empresa';//Muda o valor de $assunto para 'Empresa'.
        break;

      case 4:
        $assunto ='Aluno';//Muda o valor de $assunto para 'Aluno'
        break;

      case 5:
        $assunto = 'Outro';
        break;
    }
    return $assunto;//Retorna o valor de $assunto
  }
//////////////////////////////
function traduz_urgente($urgente)//Define a função traduz_urgente e que recebe uma única entrada.
{
  if ($urgente == 1) {//Se $concluida for igual a 1.
    return 'Sim';//Retorne 'Sim'.
  }
  else//Caso contrario.
  {
    return 'Não';//Retorne 'Não'.
  }
}
/////////////////////////////////
function tem_post()//Define a função tem_post.
  {
    if (count($_POST) > 0) {//Se a super global $_POST não estiver vazia.
      return true;//Retorne true.
    }
    else
    {
      return false;//Retorne false.
    }
  }
  /////////////////////////////
  /*function validar_data($data)//POSSIVELMENTE deletavel.
  {
    $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/';//Padrão é igual a D-M-AAAA ou DD-M-AAAA ou D-MM-AAAA ou DD-MM-AAAA.

    if (!(preg_match($padrao, $data))) {//Se $data não segue o padrão definido em $padrao.
      return false;//Retorne false.
    }
    else {//Caso contrario (Se segue o padrão).

      $dados = explode('/', $data);//$dados é o array formado por data dividio nas barras(/).
      if(checkdate($dados[1],$dados[0],$dados[2])){//Se $dados for uma data válida (Usando M-D-A pois a função é em inglês).
        return true;//Retorne true.
      }

    else {//Caso contrario (não é uma data valida).
      return false;//Retorne false.
    }
    }
  }*/
  /////////////////////////////
  /*function tratar_anexo($anexo)//Possivelmente DELETAVEL.
  {
    $padrao = '/^.+(\.pdf|\.zip)$/';//$padrao é igual a qualquer coisa terminada em .pdf ou .zip.
    $resultado = preg_match($padrao, $anexo['name']);//$resultado é a comparação do nome do anexo com $padrao.
    if (! $resultado) {//Se $resultado não é verdadeiro (é falso).
      return false;//Retorne false.
    }
    move_uploaded_file($anexo['tmp_name'],"Anexos/{$anexo['name']}");//Move o anexo para a pasta localhost/Tarefas/Anexos/{$anexo['nome']}

    return true;//Retorne verdadeiro.
  }*/
////////////////////////////////
function preparar_corpo_email($tarefa, $anexos)//Declara a função preparar_corpo_email e que recebe dois dados de entrada.
{
    ob_start();//Ativa o buffer de saida. "Avisa o php para não mostrar isso em tela".
    include "template_email.php";//Inclui o arquivo template_email.php.
    $corpo = ob_get_contents();//Pega o que estiver no buffer e coloca na variavel $corpo. "Coloca os dados/template na variavel"
    ob_end_clean();//Limpa e desativa o buffer de saida. "Avisa o php que volte a mostrar os dados"
    return $corpo;//Retorna $corpo.
}
////////////////////////////////////////
function enviar_email($tarefa, $anexos = array())//Declada a função enviar_email e avisa que recebe dois dados de entrada, sendo um deles um array vazio por default.
  {
    include "Bibliotecas/PHPMailer/src/PHPMailer.php";//declara que o PHPMailer é requerido. verificar se apenas incluir basta uma vez que o problema de conectividade for resolvido.
    $corpo = preparar_corpo_email($tarefa, $anexos); //$corpo é igual ao resultado da chamada de preparar_corpo_email
    $email = new PHPMailer();//$email é um novo objeto PHPMailer.
    $email->isSMTP();//É do tipo SMTP - mudar de acordo com o tipo de serviço de e-mail utilizado.
    $email->SMTPDebug = true;//Gera um debug da função. Provavelmente desnecessário na versão definitiva.
    $email->SMTPAuth = true;//Autenticação de SMTP sera feita - é true.
    $email->SMTPSecure = 'tls';//Tipo de segurança é 'tls' - Verificar ssl que alguns locais da internet dizem ser necessarias para e-mails google.
    $email->Host = "smtp.gmail.com";//Host do e-mail é stmp.gmail.com. Ajustar para outro host se necessário.
    $email->Port = 587;//Porta 587 - Verificar se porta 465 é a correta como dito em postagens atreladas com secure ssl
    $email->Username = "minogozzo@gmail.com";//E-mail do qual será enviado o formulário.
    $email->Password = "webloggolbew";//Senha de acesso ao e-mail.
    $email->setFrom("minogozzo@gmail.com", "Avisador de Tarefas");//Define como remetente será mostrado.
    $email->addAddress("minogozzo@gmail.com");//Define Destinatário
    $email->Subject = "Aviso de tarefa: {$tarefa['nome']}";//Assunto do e-mail.
    $email->isHTML(true);//Afirmação de que e-mail será mandado como html.
    $email->Body = $corpo;//Insere a variavel $corpo no corpo do e-mail - Revisar com a forma do livro quando conectividade for estabelecida.
    foreach ($anexos as $anexo)//Para cada anexo
    {
      $email->addAttachment("anexos/{$anexo['arquivo']}");//Incluir o anexo ao e-mail.
    }
    if (! $email->send())//Se o e-mail não for enviado - utilizado para debut. Pode provavelmente ser apenas $email->send() quando concluido
    {
      $erro = urlencode($email->ErrorInfo); //Coloque a informação de erro na variavel $erro.
      header("Location:Erro_email.php?erro=".$erro);//Encaminhe o programa para Erro_email=erro=$erro - Mostra na barra e no corpo qual erro ocorreu.
      die();//Mata(termina) a execução da função.
    }
  }
?>
