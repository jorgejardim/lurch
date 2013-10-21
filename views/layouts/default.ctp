<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title><?php echo $title_for_layout; ?> | Lurch</title>
  <?php echo $this->Html->meta('favicon.png', 'favicon.png', array('type' => 'icon')); ?>
  <!-- reWork Required Files -->
  <?php echo $this->Html->css('site/style.css')."\n"; ?>
  <?php echo $this->Html->css('site/responsive.css')."\n"; ?>  
  <?php echo $this->Html->css('ui/jquery-ui-1.10.0.custom.min')."\n"; ?>
  <?php echo $this->Html->css('ui/jquery-ui-timepicker-addon')."\n"; ?>
  <?php echo $this->Javascript->link('site/jquery-1.7.2.min.js')."\n"; ?>
  <?php echo $this->Javascript->link('site/script.js')."\n"; ?>
  <?php echo $this->Javascript->link('site/login.js')."\n"; ?>
  <!-- Google Fonts-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Hammersmith+One' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Scada' rel='stylesheet' type='text/css'>
  <!-- Wopeslider Required Files -->
  <?php echo $this->Html->css('site/wopeslider.css')."\n"; ?>
  <?php echo $this->Javascript->link('site/jquery.easing.1.3.js')."\n"; ?>
  <?php echo $this->Javascript->link('site/wopeslider.jquery.min.js')."\n"; ?>
  <?php
    if(is_file(APP.WEBROOT_DIR.DS."css".DS."pages".DS.$this->params["controller"].".css")) { echo $html->css('pages/'.$this->params["controller"])."\n"; } 
    if(is_file(APP.WEBROOT_DIR.DS."css".DS."pages".DS.$this->params["controller"]."_".$this->params["action"].".css")) { echo $html->css('pages/'.$this->params["controller"]."_".$this->params["action"])."\n"; }
    if(isset($css_for_layout)) echo $this->Html->css($css_for_layout)."\n";
    echo '<script type="text/javascript"> 
                var host       = \'http://' . $_SERVER['HTTP_HOST'] . '\';
                var www        = \'' . $this->webroot . '\'; 
                var controller = \'' . $this->params["controller"] . '\'; 
                var action     = \'' . $this->params["action"] . '\'; 
                var admin      = \'' . @$this->params["admin"] . '\';
          </script>';
    echo $this->Javascript->link(array('jquery.maskedinput.min', 
                                       'jquery.price_format.1.7.min',
                                       'ui/jquery-ui-1.10.0.custom.min', 
                                       'ui/jquery-ui-timepicker-addon', 'common',
                                       'ckeditor/ckeditor', 'ckeditor/adapters/jquery'));
    if(is_file(APP.WEBROOT_DIR.DS."js".DS."pages".DS.$this->params["controller"].".js")) { echo $javascript->link(array('pages/'.$this->params["controller"])); } 
    if(is_file(APP.WEBROOT_DIR.DS."js".DS."pages".DS.$this->params["action"].".js")) { echo $javascript->link(array('pages/'.$this->params["action"])); }
    echo $scripts_for_layout;
  ?>
  <script type="text/javascript">
    $(document).ready(function(){
        //call slider
        $('#main-slider').wopeslider({
            skin : 'rounded-white'
        });
    });
  </script>
</head>
<body>
  <div id="background">
    <div id="header">
      <div class="wrap">
        <div id="top-right">
          <?php if($session->read('Auth.User.id')) { ?>  
            Olá, <?php echo $formatacao->formata_nome($session->read('Auth.User.name')); ?>! 
            <a href="<?php echo $this->Html->url('/admin/home', true); ?>"> | Meus Eventos</a>
            <a href="<?php echo $this->Html->url('/users/logout', true); ?>"> | Sair</a>
          <?php } else { ?>  
            <div id="panel">
                <form action="<?php echo $this->Html->url('/users/login', true); ?>" method="post" accept-charset="utf-8" id="UserLoginForm">
                E-mail:
                <input name="data[User][email]" type="text" size="15">
                <br>
                Senha:
                <input name="data[User][password]" type="password" size="15">
                <br>
                <input name="Entrar" class="submit-button" type="submit" value="Entrar">
                </form>
            </div>
            <a href="#" class="btn-slide">Login</a> | 
            <a href="<?php echo $this->Html->url('/users/register', true); ?>">Cadastre-se</a>
          <?php } ?>
        </div>
        <div id="logo-box">
          <div id="logo">
            <?php echo $this->Html->image('site/images/logo-lurch.png', array('alt' => 'Confirmação de Presença', 'url' => array('controller' => 'pages', 'action' => 'home', 'admin' => false))); ?>
          </div>
        </div>
        <div id="main-menu">
          <ul>
            <li> <a class="current-menu-item" href="<?php echo $this->Html->url('/', true); ?>">Início</a>
            <li> <a href="<?php echo $this->Html->url('/p/quem-somos', true); ?>">Quem Somos</a> </li>
            <li> <a href="<?php echo $this->Html->url('/p/como-funciona', true); ?>">Como Funciona?</a> </li>
            <!-- <li> <a href="<?php echo $this->Html->url('/p/precos', true); ?>">Preços</a> </li>-->
            <li> <a href="<?php echo $this->Html->url('/p/contato', true); ?>">Contato</a> </li>
          </ul>
        </div>
        <!-- End Main Menu-->
        <div class="cleared">
        </div>
        <!-- End DropDown Menu-->
      </div>
      <!-- End Header Wrap -->
    </div>
    <!-- End Header -->
    <?php if(@$page!='home') { ?>
        <div id="page-title-bar">
        <div class="wrap">
            <h2 id="page-title">
            <?php echo $title_for_layout; ?>
            </h2>
        </div>
        </div>
        <!-- End Page Title -->
    <?php } else { ?>
        <div id="slider">
        <div class="wrap">
            <div class="wope-slider" id="main-slider" style="width:960px;height:400px;">
            <div class="wopeslider-container">
                <div class="wopeslider-slide slide1" style="time:60000000;">
                <?php echo $this->Html->image('upload/'.$conteudo['slide_1']['imagem'], 
                        array('alt' => 'wope slider', 
                                'class' => 'ws1',
                                'style' => 'easing:easeOutExpo;delay:0;time:10000;action:faderight',
								//'url' => array('controller' => 'users', 'action' => 'register', 'admin'=>false)
                            )); 
                ?>
                </div>
                <div class="wopeslider-slide slide2" style="time:60000000;">
                <?php echo $this->Html->image('upload/'.$conteudo['slide_2']['imagem'], 
                        array('alt' => 'wope slider', 
                                'class' => 'ws1',
                                'style' => 'easing:easeOutExpo;delay:0;time:10000;action:faderight',
								//'url' => array('controller' => 'users', 'action' => 'register', 'admin'=>false)
                            )); 
                ?>
                </div>
                <div class="wopeslider-slide slide3" style="time:60000000;">
                <?php echo $this->Html->image('upload/'.$conteudo['slide_2']['imagem'], 
                        array('alt' => 'wope slider', 
                                'class' => 'ws1',
                                'style' => 'easing:easeOutExpo;delay:0;time:10000;action:faderight',
								//'url' => array('controller' => 'users', 'action' => 'register', 'admin'=>false)
                            )); 
                ?>
                </div>
            </div>
            </div>
            <input type="hidden" name="hiddenField" id="hiddenField">
            <?php echo $this->Html->link('cadastre-se',                         
						array('controller' => 'users', 'action' => 'register', 'admin'=>false),
            			array('class' => 'slide-home-a')); 
            ?>
        </div>
        </div>
        <!-- End Wope Slider-->  
    <?php } ?>
    <div id="body">
        <?php 
            if(@$this->params["admin"]) {        
                echo $this->element('menu'); 
            }        
        ?>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $content_for_layout; ?>
    </div>
    <!-- End Body-->
    <div id="footer-top">
      <div class="wrap">
      </div>
    </div>
    <!-- End Footer Top -->
    <div id="footer">
      <div class="wrap">
        <!-- End Footer Widget Container-->
        <div id="footer-bottom">
          <div id="footer-copyright">
            Copyright © 2013 <a href="http://www.lurch.com.br">Lurch</a> - Todos os Direitos Reservados
          </div>
          <div class="cleared">
          </div>
        </div>
        <!-- End Footer Bottom -->
      </div>
    </div>
    <!-- End Footer -->
  </div>
  <!-- End Site Background -->
  <?php echo $this->element('sql_dump'); ?>
</body>
</html>