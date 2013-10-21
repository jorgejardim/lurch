      <div class="feature-container">
        <div class="column3_1">
          <div class="feature-text1">
            <?php echo $conteudo['como']['titulo']; ?>
          </div>
          <div class="feature-text2">
            <?php echo $conteudo['como']['texto']; ?>
          </div>
        </div>
        <div class="column3_2 column-last">
          <div class="feature-box">
            <div class="feature-icon">
              <?php echo $this->Html->image('upload/'.$conteudo['email']['imagem'], array('alt' => 'clean design')); ?>
            </div>
            <div class="feature-name">
              <a href="#"><?php echo $conteudo['email']['titulo']; ?></a>
            </div>
            <div class="feature-description">
              <?php echo $conteudo['email']['texto']; ?>
            </div>
          </div>
          <div class="feature-box">
            <div class="feature-icon">
              <?php echo $this->Html->image('upload/'.$conteudo['sms']['imagem'], array('alt' => 'powerful functions')); ?>
            </div>
            <div class="feature-name">
              <a href="#"><?php echo $conteudo['sms']['titulo']; ?></a>
            </div>
            <div class="feature-description">
              <?php echo $conteudo['sms']['texto']; ?>
            </div>
          </div>
          <div class="feature-box column-last">
            <div class="feature-icon">
              <?php echo $this->Html->image('upload/'.$conteudo['telefone']['imagem'], array('alt' => 'layer slider')); ?>
            </div>
            <div class="feature-name">
              <a href="#"><?php echo $conteudo['telefone']['titulo']; ?></a>
            </div>
            <div class="feature-description">
              <?php echo $conteudo['telefone']['texto']; ?>
            </div>
          </div>
          <div class="cleared">
          </div>
        </div>
        <div class="cleared">
        </div>
      </div>
      <!-- End Featured Container -->
      <div class="welcome-box">
        <div class="welcome-text">
          <div class="welcome-text1">
            Não perca mais tempo confirmando presenças!
          </div>
          <div class="welcome-text2">
            Deixe esse trabalho para o Lurch, que confirmará a presença de todos os seus convidados.
          </div>
        </div>
        <div class="welcome-button">
            <!-- <a class="big-button" href="#">Veja Nossos Planos</a>-->
        </div>
        <div class="cleared">
        </div>
      </div>
      <!-- End Welcome Box -->
      <!-- End Lastest Posts -->