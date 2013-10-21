Olá, <?php echo $formatacao->formata_nome($convidado['nome']); ?>.

Venha participar do <?php echo $evento['nome']; ?> no dia <?php echo substr($formatacao->data_brasileira($evento['inicio']),0,16); ?>h.

Clique no link abaixo para saber mais informações e confirmar a sua presença:

Link: <?php echo $html->url('/convidados/confirmar/'.$id, true); ?>