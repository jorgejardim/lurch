Nova confirmação de presença para <?php echo $evento['nome']; ?> no dia <?php echo substr($formatacao->data_brasileira($evento['inicio']),0,16); ?>h.

Abaixo, as informações da confirmação:

- Nome: <?php echo $convidado['nome']; ?> 
- E-mail: <?php echo $convidado['email']; ?> 
- Celular: <?php echo $convidado['celular']; ?> 
- Quantidade de Pessoas: <?php echo $convidado['qtd_confirmados']+1; ?>  