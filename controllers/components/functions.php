<?php
class FunctionsComponent extends Object {
      
    var $controller;
    
    //Inicia
    function startUp(&$controller){
        $this->controller = $controller;
    }    
        
    /** 
    * View para gerar PDF
    * @access public 
    * @return Void
    */
    function pdf($pdf=null) { 
        if($pdf) {
            $this->controller->layout = 'pdf';
            $this->controller->render($this->controller->params['action'].'_pdf'); 
        }
    } 
}