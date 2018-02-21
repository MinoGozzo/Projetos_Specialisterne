<html>
  <head>
    <meta charset="utf-8">
    <title>Formulário Recados Specialisterne</title>
  </head>

  <body>
    <form method="post">
      <fieldset>

        <label>
          Para:<!--< ?php if ($tem_erros && isset($erros_validacao['destinatario'])) : ?>-->
              <span class="erro">
                <!--< ?php echo $erros_validacao['destinatario']; ?>!-->
              </span>
            <!--< ?php endif; ?>-->
            <select name="destinatario">
              <option value=""></option>
              <option value="fernanda.lima@specialisterne.com">Fernanda</option>
              <!--Adicinar as outras opções-->
            </select>
          </label>

          <label>
            De:<!--< ?php if ($tem_erros && isset($erros_validacao['ligou'])) : ?>-->
              <span class="erro">
                <!--< ?php echo $erros_validacao['destinatario']; ?>-->
              </span>
            <!--< ?php endif; ?>-->
            <input type="text" name="ligou"><!-- inserir a expressão entre 'single -' dentro do tag -value="< ?php echo $recado['ligou']; ?>"- -->
          </label>

          <label>
            Recado:
            <textarea name="recado"></textarea> <!-- Colocar < ?php echo $recado['recado']; ?> Entre os tags de textarea-->
          </label>

          <input type="submit" value='Cadastrar';?>
          
        </fieldset>
    </form>
  </body>
</html>
