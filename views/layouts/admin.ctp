<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <title>
            SEF: <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta(
            'favicon.png',
            'favicon.png',
            array('type' => 'icon')
        );
        echo $this->Html->charset()."\n"; 
        echo $this->Html->css('cake.generic')."\n";
        echo $this->Html->css('ui/jquery-ui-1.10.0.custom.min')."\n";
        echo $this->Html->css('ui/jquery-ui-timepicker-addon')."\n";
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
        echo $this->Javascript->link(array('jquery', 'jquery.maskedinput.min', 
                                           'jquery.price_format.1.7.min',
                                           'ui/jquery-ui-1.10.0.custom.min', 
                                           'ui/jquery-ui-timepicker-addon', 'common')); 
        if(is_file(APP.WEBROOT_DIR.DS."js".DS."pages".DS.$this->params["controller"].".js")) { echo $javascript->link(array('pages/'.$this->params["controller"])); } 
        if(is_file(APP.WEBROOT_DIR.DS."js".DS."pages".DS.$this->params["action"].".js")) { echo $javascript->link(array('pages/'.$this->params["action"])); }
        echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?php echo $this->Html->link('PetCare', '/'); ?></h1>
                <h2><?php echo '<strong>'.$session->read('Auth.Group.name').':</strong> '.$session->read('Auth.User.name'); ?></h2>
                <?php echo $this->element('tree', array('plugin' => 'jmenu')); ?>
            </div>
            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $content_for_layout; ?>
            </div>
            <div id="footer">
                Copyright &#169; <?php echo date('Y'); ?> &#8226; Lurch - Todos os direitos reservados.
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>