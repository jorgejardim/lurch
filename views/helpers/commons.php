<?php
class CommonsHelper extends AppHelper {

    var $helpers = array('Html', 'Form');

    function loading($class=null, $msg=true, $aguarde='Aguarde...', $display='none') {
        
        echo '<div class="loading '.$class.'" style="display:'.$display.'">';
        echo $this->Html->image("loading_circular.gif", array('align'=>'')) . ($aguarde?' <span>'.$aguarde.'</span>':'');
        echo '</div>';
        if($msg) {
            echo '<div class="loading-msg'.($class?'-'.$class:'').'" style="display:none"></div>';
        }
    } 
    
    /** 
    * Retira caracteres nao numericos
    * @access public 
    * @param Array[] $hiddens (title,name) 
    * @return String
    */
    function report_exports($orientation, $hiddens=null, $data=array()) {
        
        echo '<ul class="menu-tabela pdf"><li>';    
        echo $this->Form->create(false, array('url' => '/html2pdf/pdf/P'));                     
        echo $this->Form->input('title', array('type'=>'hidden', 'value'=>@$hiddens['title']));
        echo $this->Form->input('name', array('type'=>'hidden', 'value'=>@$hiddens['name']));
        if(is_array($data)) {
            foreach($data as $k => $v) {
                echo $this->Form->input($k, array('type'=>'hidden', 'value'=>$v));
            }       
        }
        echo $this->Form->input('css', array('type'=>'hidden', 'value'=>$this->params['controller'].'_'.$this->params['action']));
        echo $this->Form->input('content', array('type'=>'hidden', 'id'=>'report_content'));
        echo $this->Form->input('orientation', array('type'=>'hidden', 'value'=>$orientation));
        echo $this->Form->input('type', array('type'=>'hidden', 'value'=>'pdf', 'id'=>'type'));
        if(!isset($hiddens['no_xls']))
            if(!isset($hiddens['no_xml_html'])) {
                echo $this->Form->button('Ok', array('type'=>'button', 'onclick'=>'javascript:$(\'#type\').val(\'xls\');$(this).parents(\'form\').attr(\'action\',\''.$this->webroot.'html2pdf/pdf/P\');$(this).parents(\'form\').submit()', 'class'=>'buscar xls', 'title'=>'Gerar Excel'));
            } else {
                echo $this->Form->button('Ok', array('type'=>'button', 'onclick'=>'javascript:$(\'#type\').val(\'xls\');$(this).parents(\'form\').attr(\'action\',\''.$this->webroot.$this->params['url']['url'].'/xls\');$(this).parents(\'form\').submit()', 'class'=>'buscar xls', 'title'=>'Gerar Excel'));        
            }
        if(!isset($hiddens['no_pdf'])) {
            if(!isset($hiddens['no_pdf_html'])) {
                echo $this->Form->button('Ok', array('type'=>'button', 'onclick'=>'javascript:$(\'#type\').val(\'pdf\');$(this).parents(\'form\').attr(\'action\',\''.$this->webroot.'html2pdf/pdf/P\');$(this).parents(\'form\').submit()', 'class'=>'buscar pdf', 'title'=>'Gerar PDF'));        
            } else {
                echo $this->Form->button('Ok', array('type'=>'button', 'onclick'=>'javascript:$(\'#type\').val(\'pdf\');$(this).parents(\'form\').attr(\'action\',\''.$this->webroot.$this->params['url']['url'].'/pdf\');$(this).parents(\'form\').submit()', 'class'=>'buscar pdf', 'title'=>'Gerar PDF'));        
            }
        }
        echo '</li></ul>';
        echo $this->Form->end();
    }
    
    function foto($ra=null, $id=null, $icon=false) {
        
        $imagem = '';
        if(!empty($ra)) {
            $ra = $this->apenas_numeros($ra);
        }
        if(is_file(APP.WEBROOT_DIR.DS.'avatars'.DS.'RA-'.$ra.'.jpg') && !empty($ra)) { 
            $imagem = '/avatars/RA-'.$ra;
        } elseif(is_file(APP.WEBROOT_DIR.DS.'avatars'.DS.$id.'.jpg') && !empty($id)) { 
            $imagem = '/avatars/'.$id;
        } elseif(is_file(APP.WEBROOT_DIR.DS.'avatars'.DS.$ra.'.jpg') && !empty($ra)) {
            $imagem = '/avatars/'.$ra;
        } elseif($icon) {
            $imagem = '/img/icons/foto';
        }
        if($imagem) {
            return $this->Html->image($this->Html->url($imagem.'.jpg',true), array('class'=>'foto'));
        } else {
            return '';
        }
    }
    
    /** 
    * Retira caracteres nao numericos
    * @access public 
    * @param String[] $str 
    * @return String
    */
    function apenas_numeros($var) {
        $tamanho = strlen($var);
        $numeros = array("0","1","2","3","4","5","6","7","8","9");
        $res = "";
        for($i=0; $i<$tamanho; $i++) {
                $str = substr($var, $i, 1);
                $existir = in_array($str,$numeros);
                if($existir) {
                        $res .= $str;
                }
        }
        $res = chop($res);   
        return $res;
    }
        
    /** 
    * Retorna o valor mais proximo
    * @access public 
    * @param String[] $value 
    * @param Array[] $array 
    * @return String
    */
    function near($number, $array) {

        if (false !== ($exact = array_search($number, $array))) {
            return $array[$exact];
        }

        rsort($array);
        $res = $array[count($array)-1];
        foreach ($array as $value) {
            if ($value > $number) {
                $res = $value;
            } else {
                $menor = abs($number - $value);
                $maior = abs($number - $res);
                if($menor < $maior) {
                    return $value;
                } else {
                    return $res;
                }
            }
        }    
        return $res;
    }
}