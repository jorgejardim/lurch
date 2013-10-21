      <div class="breadcrumb">
        <a href="index.html">Início</a> &#8250; Como Funciona?
      </div>
      <div class="welcome-box">
        <div class="welcome-text1">
          <?php echo $conteudo['confirmamos']['titulo']; ?>
        </div>
        <div class="welcome-text2"><?php echo $conteudo['confirmamos']['texto']; ?></div>
      </div>
      <!-- End Welcome Box -->
      <div class="column2_1 no_margin">
        <h5 class="big_title">
          <?php echo $conteudo['upload']['titulo']; ?>
        </h5>
        <div class="column3_1 center">
          <?php echo $this->Html->image('upload/'.$conteudo['upload']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <div class="column3_2 column-last">
          <p><?php echo $conteudo['upload']['texto']; ?></p>
        </div>
        <div class="cleared">
        </div>
      </div>
      <div class="column2_1 column-last no_margin">
        <h5>
          <?php echo $conteudo['email']['titulo']; ?>
        </h5>
        <div class="column3_1 center">
          <?php echo $this->Html->image('upload/'.$conteudo['email']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <div class="column3_2 column-last">
          <p><?php echo $conteudo['email']['texto']; ?></p>
        </div>
        <div class="cleared">
        </div>
      </div>
      <div class="cleared">
      </div>
      <div class="column2_1 no_margin">
        <h5>
          <?php echo $conteudo['sms']['titulo']; ?>
        </h5>
        <div class="column3_1 center">
          <?php echo $this->Html->image('upload/'.$conteudo['sms']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <div class="column3_2 column-last">
          <p><?php echo $conteudo['sms']['texto']; ?></p>
        </div>
        <div class="cleared">
        </div>
      </div>
      <div class="column2_1 column-last no_margin">
        <h5>
          <?php echo $conteudo['telefone']['titulo']; ?>
        </h5>
        <div class="column3_1 center">
          <?php echo $this->Html->image('upload/'.$conteudo['telefone']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <div class="column3_2 column-last">
          <p><?php echo $conteudo['telefone']['texto']; ?></p>
        </div>
        <div class="cleared">
        </div>
      </div>
      <div class="cleared">
      </div>
      <div class="column2_1 no_margin">
        <h5>
          <?php echo $conteudo['festa']['titulo']; ?>
        </h5>
        <div class="column3_1 center">
          <?php echo $this->Html->image('upload/'.$conteudo['festa']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <div class="column3_2 column-last">
          <?php echo $conteudo['festa']['texto']; ?>
        </div>
        <div class="cleared">
        </div>
      </div>
      <div class="column2_1 column-last no_margin">
        <h5>
          <?php echo $conteudo['relatorio']['titulo']; ?>
        </h5>
        <div class="column3_1 center">
          <?php echo $this->Html->image('upload/'.$conteudo['relatorio']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <div class="column3_2 column-last">
          <?php echo $conteudo['relatorio']['texto']; ?>
        </div>
        <div class="cleared">
        </div>
      </div>
      <div class="cleared">
      </div>
      <!-- End Service Items -->
    </div>