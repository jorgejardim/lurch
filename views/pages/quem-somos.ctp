      <div class="breadcrumb">
        <a href="index.html">Início</a> &#8250; Quem Somos
      </div>
      <div class="column3_1">
        <div class="light_bolder" >
          <?php echo $this->Html->image('upload/'.$conteudo['quem-somos']['imagem'], array('alt' => 'rework template')); ?>
        </div>
      </div>
      <div class="column3_2 column-last">
        <h4>
          <?php echo $conteudo['quem-somos']['titulo']; ?>
        </h4>
        <p><?php echo $conteudo['quem-somos']['texto']; ?></p>
      </div>
      <div class="cleared">
      </div>
      <!-- End About Company -->
      <hr>
      <div class="column3_1">
        <h5>
          <?php echo $conteudo['empresa']['titulo']; ?>
        </h5>
        <p><?php echo $conteudo['empresa']['texto']; ?></p>
      </div>
      <div class="column3_1">
        <h5>
          <?php echo $conteudo['porque']['titulo']; ?>
        </h5>
        <?php echo $conteudo['porque']['texto']; ?>
      </div>
      <div class="column3_1 column-last">
        <h5>
          <?php echo $conteudo['missao']['titulo']; ?>
        </h5>
        <blockquote><?php echo $conteudo['missao']['texto']; ?></blockquote>
      </div>
      <div class="cleared">
      </div>
      <!-- End 3 What Columns -->
      <hr>
      <h4>
        <?php echo $conteudo['equipe_1']['titulo']; ?>
      </h4>
      <div class="column4_1">
        <div class="user_profile" >
          <?php echo $this->Html->image('upload/'.$conteudo['equipe_1']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <p><?php echo $conteudo['equipe_1']['texto']; ?></p>
        <div>
          <a class="social-facebook" href="#"></a> <a class="social-digg" href="#"></a> <a class="social-twitter" href="#"></a> <a class="social-pinterest" href="#"></a>
        </div>
      </div>
      <div class="column4_1">
        <div class="user_profile" >
          <?php echo $this->Html->image('upload/'.$conteudo['equipe_2']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <p><?php echo $conteudo['equipe_2']['texto']; ?></p>
        <div>
          <a class="social-facebook" href="#"></a> <a class="social-digg" href="#"></a> <a class="social-twitter" href="#"></a> <a class="social-pinterest" href="#"></a>
        </div>
      </div>
      <div class="column4_1">
        <div class="user_profile" >
          <?php echo $this->Html->image('upload/'.$conteudo['equipe_3']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <p><?php echo $conteudo['equipe_3']['texto']; ?></p>
        <div>
          <a class="social-facebook" href="#"></a> <a class="social-digg" href="#"></a> <a class="social-twitter" href="#"></a> <a class="social-pinterest" href="#"></a>
        </div>
      </div>
      <div class="column4_1 column-last">
        <div class="user_profile" >
          <?php echo $this->Html->image('upload/'.$conteudo['equipe_4']['imagem'], array('alt' => 'rework template')); ?>
        </div>
        <p><?php echo $conteudo['equipe_4']['texto']; ?></p>
        <div>
          <a class="social-facebook" href="#"></a> <a class="social-digg" href="#"></a> <a class="social-twitter" href="#"></a> <a class="social-pinterest" href="#"></a>
        </div>
      </div>
      <div class="cleared">
      </div>
      <!-- End Meet Our Team -->
    </div>