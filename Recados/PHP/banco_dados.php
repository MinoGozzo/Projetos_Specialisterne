<?php

$conexao = mysqli_connect(SERVIDOR_BD,USUARIO_BD,SENHA_BD, RECADOS_BD);//Estabelece a conexão com o BD.
if (mysqli_connect_errno($conexao)) {
  echo "Problemas ao estabelcer a conexão com o banco de dados. Favor verificar os dados.";
  die();//Encerra a execução.
}
//////////////////////////////
function buscar_recados($conexao)//Declaração da função buscar_recados
  {
    $sqlBusca = 'SELECT * FROM  recados';//Define um string $sqlBusca com o código mysql adequado.
    $resultado = mysqli_query($conexao, $sqlBusca);//Roda um query com o código no banco conectado.

    $recados = array();//Define $recados como um array.

    while ($recado= mysqli_fetch_assoc($resultado)){//Enquanto houver resultados sendo inseridos em $recado.
      $recados[] = $recado;//$recados é um array que tem $recado como indice.
    }
    return $recados;//Retorne $recados.
  }
  //////////////////////////////
  function gravar_recado($conexao, $recado)
  {
    $sqlGravar = "INSERT INTO recados
                  (nome, nome_do_contato,telefone_do_contato, assunto,outro,urgente)
                  VALUES(
                    '{$recado['nome']}',
                    '{$recado['nomedocontato']}',
                    {$recado['telefonedocontato']},
                    {$recado['assunto']},
                    '{$recado['outro']}',
                    {$recado['urgente']}
                  )
    ";

    mysqli_query($conexao, $sqlGravar);
  }
  ///////////////////////////////////
  function buscar_recado($conexao, $id)//Declaração da função buscar_recado.
{
  $sqlBusca ='SELECT * FROM recados WHERE id = ' . $id;//Define o string $sqlBusca com o código mysql adequado.
  $resultado = mysqli_query($conexao, $sqlBusca);//Executa um query usando $sqlBusca como argumento e armazena o resultado na variavel $resultado
  return mysqli_fetch_assoc($resultado);//Retorna $resultado processado por mysqli_fetch_assoc.
}
////////////////////////////////////
function editar_recado($conexao, $recado)//Declaração da função editar_recado.
  {
      $sqlEditar = "UPDATE recados SET #Definição do string $sqlEditar com o comando mysql das linhas 48 a 55
              nome = '{$recado['nome']}',
              nome_do_contatodocontato = '{$recado['nomedocontato']}',
              telefone_do_contato = {$recado['telefonedocontato']},
              assunto = {$recado['assunto']},
              outro = '{$recado['outro']}',
              concluida = {$recado['concluida']}
          WHERE id = {$recado['id']}
      ";
      mysqli_query($conexao, $sqlEditar);//Executa um query usando o string $sqlEditar.
  }
  ////////////////////////////////////
  function remover_recado($conexao, $id)//Declaração da função remover_recado.
  {
    $sqlRemover = "DELETE FROM recados WHERE id = {$id}";//Define $sqlRemover como um string com o comando mysql.

    mysqli_query($conexao, $sqlRemover);//Executa um query utilizando $sqlRemover.
  }
  ////////////////////////////////////
  function gravar_anexo($conexao, $anexo)//Declaração da função gravar_anexo - Provavelmente apagavel.
{
  $sqlGravar ="INSERT INTO anexos #Define $sqlGravar como um string com o comando mysql relevante. Linhas 68 a 75.
          (recado_id, nome, arquivo)
          VALUES
          (
            {$anexo['recado_id']},
            '{$anexo['nome']}',
            '{$anexo['arquivo']}'
          )";

  mysqli_query($conexao, $sqlGravar);//Executa um query com $sqlGravar.
}
/////////////////////////////////////////
function buscar_anexos($conexao, $recado_id)//Declaração da função buscar_anexos - Provavelmente apagavel
{
  $sql = "SELECT * FROM anexos WHERE recado_id = {$recado_id}";//Define $sql como um string de código sql relevante
  $resultado = mysqli_query($conexao, $sql);//Define $resultado como o query de $sql.
  $anexos = array();//Declara $anexos como sendo array.

  while ($anexo = mysqli_fetch_assoc($resultado)) {//Enquanto anexos forem encontrados
    $anexos[] = $anexo;//$anexos é um array que tem como indices $anexo
  }
  return $anexos;//Retorne $anexos.
}

 ?>
