<?php
class CommonsComponent extends Object {
        
    /** 
    * Função retorna a data no formado americano
    * @access public 
    * @param String[] $data 
    * @return Int
    */
    function data_americana($data) { 
        if(strstr($data, "/")) {
            $data = $this->converte_data($data);
        }
        if($data=='0000-00-00' || $data=='0000-00-00 00:00:00')
            $data = null;
        return $data;
    }  
        
    /** 
    * Função retorna a data no formado brasileiro
    * @access public 
    * @param String[] $data 
    * @return Int
    */
    function data_brasileira($data) { 
        if(strstr($data, "-")) {
            $data = $this->converte_data($data);
        }
        return $data;
    }  
    
    /** 
    * Função para conversão de datas 
    * (aaaa-mm-dd -> dd/mm/aaaa || dd/mm/aaaa -> aaaa-mm-dd) (com ou sem H:i:s)
    * @access public 
    * @param Date[] $data
    * @return Date[]  
    */    
    function converte_data($data) {

        $data = trim($data);
        $exp  = explode(' ',$data);
        $data = $exp[0];
        if(strstr($data, "/")) {
                $a = explode ("/", $data);
                $v_data = $a[2] . "-". $a[1] . "-" . $a[0];
        } else {
                $a = explode ("-", $data);
                $v_data = $a[2] . "/". $a[1] . "/" . $a[0];	
        }        
        if(isset($exp[1]))
            $v_data .= ' '.$exp[1];
        if(($data!='0000-00-00')and($data!='00/00/000')and($data))
            return $v_data;
    }
    
    /** 
    * Função que soma dias em datas
    * @access public 
    * @param String[] $pData Data incial
    * @param String[] $pDias Quantidade de dias para a soma
    * @return String[]  
    */
    function soma_data($pData, $pDias) { 
        $pData = $this->data_americana($pData);
        if(@ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})", $pData, $vetData)){; 
            $fDia = $vetData[3]; 
            $fMes = $vetData[2]; 
            $fAno = $vetData[1]; 

            for($x=0;$x<$pDias;$x++){ 
                if($fMes == 1 || $fMes == 3 || $fMes == 5 || $fMes == 7 || $fMes == 8 || $fMes == 10 || $fMes == 12) { 
                    $fMaxDia = 31; 
                } elseif($fMes == 4 || $fMes == 6 || $fMes == 9 || $fMes == 11) { 
                    $fMaxDia = 30; 
                } else { 
                    if($fMes == 2 && $fAno % 4 == 0 && $fAno % 100 != 0) { 
                        $fMaxDia = 29; 
                    } elseif($fMes == 2) { 
                        $fMaxDia = 28; 
                    } 
                } 
                $fDia++; 
                if($fDia > $fMaxDia) { 
                    if($fMes == 12) { 
                        $fAno++; 
                        $fMes = 1; 
                        $fDia = 1; 
                    } else { 
                        $fMes++; 
                        $fDia = 1; 
                    } 
                } 
            } 
            if(strlen($fDia) == 1) $fDia = "0" . $fDia; 
            if(strlen($fMes) == 1) $fMes = "0" . $fMes; 
            return $fAno."-".$fMes."-".$fDia; 

        } else { 
            return "Data Inválida."; 
        } 
    } 

    /** 
    * Função que subtrai dias em datas
    * @access public 
    * @param Date[] $pData Data incial
    * @param Date[] $pDias Quantidade de dias para a subtração
    * @return Date[]  
    */
    function subtrai_data($pData, $pDias) { 
        $pData = $this->data_americana($pData);
        if(ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})", $pData, $vetData)) {
            $fDia = $vetData[3]; 
            $fMes = $vetData[2]; 
            $fAno = $vetData[1]; 

            for($x=0;$x<$pDias;$x++) { 
                $fDia--; 

                if($fDia == 0) $fMes--; 
                if($fMes == 0) { $fAno--; $fMes = 12;} 

                if($fDia == 0) { 
                    if($fMes == 1 || $fMes == 3 || $fMes == 5 || $fMes == 7 || $fMes == 8 || $fMes == 10 || $fMes == 12) { 
                        $fDia = 31; 
                    } elseif($fMes == 4 || $fMes == 6 || $fMes == 9 || $fMes == 11) { 
                        $fDia = 30; 
                    } else { 
                        if($fMes == 2 && $fAno % 4 == 0 && $fAno % 100 != 0) { 
                            $fDia = 29; 
                        } elseif($fMes == 2) { 
                            $fDia = 28; 
                        } 
                    } 
                } 
            } 
            if(strlen($fDia) == 1) $fDia = "0" . $fDia; 
            if(strlen($fMes) == 1) $fMes = "0" . $fMes; 
            return $fAno."-".$fMes."-".$fDia; 
        } else { 
            return "Data Inválida."; 
        } 
    }     
    
    /** 
    * Função retorna o último dia do mes
    * @access public 
    * @param String[] $data 
    * @return Int
    */
    function ultimo_dia_mes($data=false){
        if (!$data) {
            $data = date("d/m/Y");
        }        
        $data = ($this->data_brasileira($data));  
        list($dia, $mes, $ano) = explode("/", $data);
        return date("d", mktime(0, 0, 0, $mes+1, 0, $ano));                
    }    
    
    /** 
    * Função retorna o numero do dia da semana
    * @access public 
    * @param String[] $data 
    * @return Int
    */
    function numero_dia($data) { 
        $data = $this->data_americana($data);
        $data = explode(" ",$data);
        $data = explode("-",$data[0]);
        $diasemana = date("w", mktime(0,0,0,$data[1],$data[2],$data[0]));
        return $diasemana;
    }      
    
    /** 
    * Retorna a Idade a partir da data de nascimento 
    * @access public 
    * @param Date[] $nascimento 
    * @return String
    */
    function retorna_idade($nascimento) {
        $nascimento = $this->data_americana($nascimento);
        list($anoNasc,$mesNasc,$diaNasc) = explode("-",$nascimento);
        list($ano,$mes,$dia)             = explode("-",date("Y-m-d"));
        $idade = $ano-$anoNasc;
        $idade = (($mes<$mesNasc)or(($mes==$mesNasc)and($dia<$diaNasc))) ? --$idade : $idade;
        return $idade;
    }  
    
    /** 
    * Função que retorna a quantidade de dias uteis entre duas datas
    * @access public 
    * @param Date[] $from       Data incial 
    * @param Date[] $to         Data final 
    * @param Array[]  $feriados   Array de datas nao uteis 
    * @return Int[]   Quantidade de dias 
    */
    function dias_uteis($dataInicial, $dataFinal, $feriados, $final_de_semana=false) {
        $dataInicial = $this->data_americana($dataInicial);
        $dataFinal   = $this->data_americana($dataFinal);
        
        $total_feriados = sizeof($feriados);
        $qtd_dias       = $this->diferencas_de_datas($dataInicial,$dataFinal);
        $dias_uteis     = 0;
        $dias_nao_uteis = 0;
        sort($feriados);

        for($i=0; $i<=$qtd_dias; $i++) {

            //pega os dias um a um
            if($i>0) {
                $data_dia = $this->soma_data($dataInicial,$i);
            } else {
                $data_dia = $dataInicial;
            }
            
            $data_formatada = explode("-",$data_dia);
            $data_verifica  = mktime (0,0,0,$data_formatada[1],$data_formatada[2],$data_formatada[0]);

            //pega dia da semana
            $dia_semana = date("w", mktime (0,0,0,$data_formatada[1],$data_formatada[2],$data_formatada[0]));

            //tira sábado e domingo
            $domingo = 0; $sabado = 6;
            if($final_de_semana) {
                $domingo = 99; $sabado = 99;
            }
            if(($dia_semana != $domingo) and ($dia_semana != $sabado)) {

                $dias_uteis++;
                //pega os feriados fora de fins de semana
                for($j=0; $j<$total_feriados; $j++) {
                    $feriado_dia = $this->data_americana($feriados[$j]);
                    $feriado_formatado = explode("-",$feriado_dia);
                    $feriado_verifica  = mktime (0,0,0,$feriado_formatado[1],$feriado_formatado[2],$feriado_formatado[0]);
                    if($data_verifica == $feriado_verifica) {
                        $dias_nao_uteis++;
                    }
                }
            }
        }
        return $dias_uteis - $dias_nao_uteis;
    }   
    
    /** 
    Função que retorna a quantidade de dias entre duas datas
    @access public 
    @param String[] $from Data incial
    @param String[] $to   Data final
    @return Int[]   Quantidade de dias 
    */
    function diferencas_de_datas($from, $to) { 
        $from = $this->data_americana($from);
        $to   = $this->data_americana($to);
        
        list( $from_year, $from_month, $from_day) = explode("-", $from); 
        list( $to_year, $to_month, $to_day) = explode("-", $to); 

        $from_date = mktime(0,0,0,$from_month,$from_day,$from_year); 
        $to_date   = mktime(0,0,0,$to_month,$to_day,$to_year); 

        $days = ($to_date - $from_date)/86400;
        $days = ceil($days) ;

        return $days; 
    }   
    
    /** 
    * Retorna a quantidade desejada de proximos dias uteis
    * @access public 
    * @param Date[] $data_inicial 
    * @param Int[] $qtd_datas 
    * @param Array[] $dias_semana 
    * @param Array[] $feriados 
    * @return Array
    */    
    function proximas_datas_uteis($data_inicial, $qtd_datas, $dias_semana, $feriados, $final_de_semana=false) {
        $data_inicial = $this->data_americana($data_inicial);
        for($q=0;$q<$qtd_datas;$q++) {
            $i = 0;
            do {
                $data_inicial = $this->soma_data($data_inicial, 1, 0);
                $total = $this->dias_uteis($data_inicial, $data_inicial, $feriados, $final_de_semana);

                if($total) {
                    if (in_array($this->numero_dia($data_inicial), $dias_semana)) {
                        $i = 1;
                        $datas[] = $data_inicial;
                    }
                }
            } while($i<1);
        }
        return $datas;
    } 
    
    /** 
    * Verifica se a data é dia Util
    * se não for, retorna a proxima data
    * @access public 
    * @param Date[] $data_inicial 
    * @param Int[] $qtd_datas 
    * @param Array[] $dias_semana 
    * @param Array[] $feriados 
    * @return Array
    */   
    function verifica_data_util($data, $dias_semana, $feriados) {
        $data = $this->data_americana($data);
        $i = 0;
        do {
            $feriado = 0;
            if (in_array($this->data_brasileira($data), $feriados)) {                
                $feriado = 1;
            }
            if (in_array($this->numero_dia($data), $dias_semana) && !$feriado) {                
                $i = 1;
            }
            if(!$i) {
                $data = $this->soma_data($data, 1, 0);
            }
        } while($i<1);     
        return $data;
    }    
    
    /** 
    * Funcao que retorna as datas entre duas datas
    * @access public 
    * @param String[] $from       Data incial (aaaa-mm-dd)
    * @param String[] $to         Data final (aaaa-mm-dd)
    * @return Array[] Datas (aaaa-mm-dd)
    */
    function datas_entre_datas($data_inicial, $data_final) {

        $qtd_dias = $this->diferencas_de_datas($data_inicial, $data_final);
        for($i=0; $i<=$qtd_dias; $i++) {
            if($i>0) {
                $data_dia = $this->soma_data($data_inicial,$i);
            } else {
                $data_dia = $this->data_americana($data_inicial);
            }
            $datas[] = $data_dia;
        }
        return $datas;
    }    
        
    /** 
    * Função retorna o dia da semana a partir de uma data  
    * @access public 
    * @param String[] $data 
    * @param Int[] $dia 
    * @param Int[] $abreviado 
    * @return String
    */
    function escreve_dia_semana($data=null, $dia=null, $abreviado=0) {  

        if($data) {
            $data = $this->data_americana($data);
            $data = explode("-",$data);
            $dia  = date("w", mktime(0,0,0,$data[1],$data[2],$data[0]));
        }
        
        switch($dia) { 
            case '0' : $diaext = 'Domingo';        break; 
            case '1' : $diaext = 'Segunda-feira';  break; 
            case '2' : $diaext = 'Terça-feira';    break; 
            case '3' : $diaext = 'Quarta-feira';   break; 
            case '4' : $diaext = 'Quinta-feira';   break; 
            case '5' : $diaext = 'Sexta-feira';    break; 
            case '6' : $diaext = 'Sábado';         break; 
        }               
        
        if($abreviado) {
            return "<abbr title=\"".$diaext."\" class=\"noborder\">".substr($diaext,0,3)."</abbr>";
        } else {
            return $diaext;
        }
    } 
    
    /** 
    * Função para formatação de Bytes 
    * @access public 
    * @param Int[] $a_bytes 
    * @return String
    */
    function formata_bytes($a_bytes) {
        if ($a_bytes < 1024) {
            return $a_bytes .' B';
        } elseif ($a_bytes < 1048576) {
            return round($a_bytes / 1024, 2) .' KB';
        } elseif ($a_bytes < 1073741824) {
            return round($a_bytes / 1048576, 2) . ' MB';
        } elseif ($a_bytes < 1099511627776) {
            return round($a_bytes / 1073741824, 2) . ' GB';
        } elseif ($a_bytes < 1125899906842624) {
            return round($a_bytes / 1099511627776, 2) .' TB';
        } elseif ($a_bytes < 1152921504606846976) {
            return round($a_bytes / 1125899906842624, 2) .' PB';
        } elseif ($a_bytes < 1180591620717411303424) {
            return round($a_bytes / 1152921504606846976, 2) .' EB';
        } elseif ($a_bytes < 1208925819614629174706176) {
            return round($a_bytes / 1180591620717411303424, 2) .' ZB';
        } else {
            return round($a_bytes / 1208925819614629174706176, 2) .' YB';
        }
    }  
    
    /** 
    * Retira acentuação 
    * @access public 
    * @param String[] $str 
    * @return String
    */
    function retira_acentos( $str ) {
        $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
        $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
        return str_replace( $array1, $array2, $str );
    }     
    
    /** 
    * Limpa nomes de arquivos 
    * @access public 
    * @param String[] $str 
    * @return String
    */
    function name_files($str) {        
        $str = $this->retira_acentos(strtolower(trim(substr($str, 0, 30))));
        $charvalidos = "abcdefghijklmnopqrstuvwxyz0123456789-_";
        for ($i=0; $i<strlen($str); $i++) { 
            $char = substr($str, $i, 1); 
            if (substr_count($charvalidos, $char)==0) { 
                $str = str_replace($char,"-",$str);
            } 
        }
        return $str;
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
    * FORMATA NOME DE PESSOAS
    * 
    * $retorna
    *    nome           ->  rerna apenas o nome
    *    sobrenome      ->  retorna apenas o sobrenome
    *    nomesobrenome  ->  retorna o nome e sobrenome
    *    abreviado      ->  retorna o nome completo abreviado
    *    completo       ->  retorna o nome completo
    *    maximo         ->  tamanho maximo para abreviar o minimo possivel
    * $maxtamanho
    *    tamanho maximo de caracteres q deve ter o nome
    * $exibi_msg
    *    exibe erro se ultrapassar o tamanho maximo
    */      
    function formata_nome($nomecompleto, $retorna="nome", $maxtamanho=0, $exibi_msg=0){ 

            //retira os espaços consecutivos
            //$nomecompleto = utf8_encode($nomecompleto);
            $nomecompleto = preg_replace("/_/", ' ', trim($nomecompleto));
            $nomecompleto = preg_split("/\s+/", trim($nomecompleto));
            $nomecompleto = implode(" ", $nomecompleto);	

            //quebra a string nos espaços
            $nome    = explode(" ", trim($nomecompleto));
            $tamanho = sizeof($nome); 

            //converte o primeiro caractere de cada nome para maiusculo
            for($i=0; $i<$tamanho; $i++) { 
                if (($nome[$i]!="de") and ($nome[$i]!="da") and ($nome[$i]!="e") and ($nome[$i]!="dos") and ($nome[$i]!="das") and ($nome[$i]!="do") and ($nome[$i]!="o") and ($nome[$i]!="a")) { 
                    //$nome[$i] = ucfirst(mb_strtolower($nome[$i])); 
                    $nome[$i] = ucfirst(mb_strtolower($nome[$i], 'UTF-8')); 
                } 
            } 

            //retorna apenas o nome
            if($retorna=="nome")
                return $nome[0];

            //retorna apenas o sobrenome
            if($retorna=="sobrenome")
                return $nome[$tamanho-1];

            //retorna apenas o nome e sobrenome
            if($retorna=="nomesobrenome")
                return $nome[0]." ".$nome[$tamanho-1];

            //retorna o nome completo
            if($retorna=="completo") {
                $completo = '';
                for($i=0; $i<$tamanho; $i++) { 
                if($i==$tamanho-1) {$espaco="";} else {$espaco=" ";}
                        $completo .= $nome[$i].$espaco;                              
                } 
                return $completo;
            }

            //retorma o nome abreviado
            if($retorna=="abreviado") { 
                $abreviado = $nome[0]." "; 
                for($i=1; $i<$tamanho-1; $i++){ 
                    if (($nome[$i]!="de") and ($nome[$i]!="da") and ($nome[$i]!="e") and ($nome[$i]!="dos") and ($nome[$i]!="das") and ($nome[$i]!="do")) { 
                        $reducao = substr($nome[$i], 0, 1); 
                        $abreviado .= $reducao.". "; 
                    } else { 
                        $abreviado .= $nome[$i]." "; 
                    } 
                }
                $abreviado .= $nome[$tamanho-1]; 
                $abreviado = str_replace('Ee', 'EE', $abreviado);
                $abreviado = str_replace('Emef', 'EMEF', $abreviado);
                $abreviado = str_replace('Emeb', 'EMEB', $abreviado);
                $abreviado = str_replace('Avenida', 'Av.', $abreviado);
                $abreviado = str_replace('Engenheiro', 'Eng.', $abreviado);
                return $abreviado; 
            } 

            //retorma o nome maximo
            $maximo = ''; $repete = 0;
            if($retorna=="maximo") { 
                for($i=0; $i<$tamanho; $i++) { 
                    if($i==$tamanho-1) {$espaco="";} else {$espaco=" ";}
                    $maximo .= $nome[$i].$espaco;                              
                } 
                if(strlen($maximo)>$maxtamanho) {
                    for($i=$tamanho-2; $i>0; $i--){ 
                        if (($nome[$i]!="de") and ($nome[$i]!="da") and ($nome[$i]!="e") and ($nome[$i]!="dos") and ($nome[$i]!="das") and ($nome[$i]!="do")) { 
                                $meio[] = $nome[$i]." ";
                        }
                    }
                        $tamanho_meio = sizeof($meio)-1;
                    $vezes = 0;
                    do {
                            $maximo = str_replace($meio[$vezes],substr($meio[$vezes], 0, 1).". ",$maximo);
                            if((strlen($maximo)<=$maxtamanho) or ($vezes==$tamanho_meio)) {
                                $repete = 1;
                            }
                            ++$vezes;
                    } while($repete<1);
                }
                if((strlen($maximo)>$maxtamanho) and ($exibi_msg)) {
                    return "Mesmo abreviado, o nome ultrapassa o tamanho máximo permitido.";  
                } else {
                    $maximo = str_replace('Ee', 'EE', $maximo);
                    $maximo = str_replace('Emef', 'EMEF', $maximo);
                    $maximo = str_replace('Emeb', 'EMEB', $maximo);
                    $maximo = str_replace('Avenida', 'Av.', $maximo);
                    $maximo = str_replace('Engenheiro', 'Eng.', $maximo);
                    return $maximo; 
                }
            } 
    }     
}