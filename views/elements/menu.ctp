      <div class="column4_1">
        <div class="widget">
          <div class="widget-title">
            <span>Menu</span>
          </div>
          <ul>
            <li><a href="<?php echo $this->Html->url('/admin/eventos/add', true); ?>">Incluir Evento</a></li>
            <li><a href="<?php echo $this->Html->url('/admin/eventos', true); ?>">Administrar Evento</a></li>
            <li><a href="<?php echo $this->Html->url('/admin/users/my_data', true); ?>">Meu Cadastro</a></li>
          </ul>
            
          <?php if( ADM == 1 ) { ?>  
            
            <div class="widget-title">
                <span>Menu Administrativo</span>
            </div>
            <ul>
                <li><a href="<?php echo $this->Html->url('/admin/users', true); ?>">Usuários</a></li>
                <li><a href="<?php echo $this->Html->url('/admin/configs', true); ?>">Configurações</a></li>
                <li><a href="<?php echo $this->Html->url('/admin/conteudos', true); ?>">Conteúdo do Site</a></li>
                <li><a href="<?php echo $this->Html->url('/admin/locais', true); ?>">Locais Privados</a></li>                
            </ul>  

          <?php } ?>   
        </div>
      </div>