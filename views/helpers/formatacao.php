<?php
/**
 * Helper para formatação de dados no padrão brasileiro
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Formatação Helper
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/helper-formatao
 */
class FormatacaoHelper extends AppHelper {

/**
 * Helpers auxiliares
 *
 * @var array
 * @access public
 */
	var $helpers = array('Time', 'Number');

/**
 * Formata a data
 *
 * @param integer $data Data em timestamp ou null para atual
 * @param array $opcoes É possível definir o valor de 'invalid' e 'userOffset' que serão usados pelo helper Time
 * @return string Data no formato dd/mm/aaaa
 * @access public
 */
	function data($data = null, $opcoes = array()) {
		$padrao = array(
			'invalid' => '31/12/1969',
			'userOffset' => null
		);
		$config = array_merge($padrao, $opcoes);

		$data = $this->_ajustaDataHora($data);
		return $this->Time->format('d/m/Y', $data, $config['invalid'], $config['userOffset']);
	}

/**
 * Formata a data e hora
 *
 * @param integer $dataHora Data e hora em timestamp ou null para atual
 * @param boolean $segundos Mostrar os segundos
 * @param array $opcoes É possível definir o valor de 'invalid' e 'userOffset' que serão usados pelo helper Time
 * @return string Data no formato dd/mm/aaaa hh:mm:ss
 * @access public
 */
	function dataHora($dataHora = null, $segundos = true, $opcoes = array()) {
		$padrao = array(
			'invalid' => '31/12/1969',
			'userOffset' => null
		);
		$config = array_merge($padrao, $opcoes);

		$dataHora = $this->_ajustaDataHora($dataHora);
		if ($segundos) {
			return $this->Time->format('d/m/Y \à\s H:i:s', $dataHora, $config['invalid'], $config['userOffset']).'h';
		}
		return $this->Time->format('d/m/Y \à\s H:i', $dataHora, $config['invalid'], $config['userOffset']).'h';
	}    

/**
 * Mostrar a data completa
 *
 * @param integer $dataHora Data e hora em timestamp ou null para atual
 * @return string Descrição da data no estilo "Sexta-feira", 01 de Janeiro de 2010, 00:00:00"
 * @access public
 */
	function dataCompleta($dataHora = null, $abrev=true, $semana=true) {
		$_diasDaSemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
		$_meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
                
                $hora = false;
                if(strlen($dataHora)>10) $hora = true;

		$dataHora = $this->_ajustaDataHora($dataHora);
		$w = date('w', $dataHora);
		$n = date('n', $dataHora) - 1;
                
                if($abrev) {
                    $nome_dia[$w] = substr($_diasDaSemana[$w], 0, strpos($_diasDaSemana[$w], '-'));
                    if(!$nome_dia[$w]) $nome_dia[$w] = $_diasDaSemana[$w];
                    $_meses[$n]        = substr($_meses[$n],0,3);
                }  
                
                if($semana==true) {
                    $data  = sprintf('%s, %02d de %s de %04d', $nome_dia[$w], date('d', $dataHora), $_meses[$n], date('Y', $dataHora));                
                } else {
                    $data  = sprintf('%02d de %s de %04d', date('d', $dataHora), $_meses[$n], date('Y', $dataHora));                
                }
                if($hora) {
                    $data .= ' às '.date('H:i', $dataHora).'h';
                }
                
                return $data;                
        }           

/**
 * Formata Hora
 *
 * @param integer $dataHora Data e hora em timestamp ou null para atual
 * @return string Descrição da data no estilo "Sexta-feira", 01 de Janeiro de 2010, 00:00:00"
 * @access public
 */
	function hora($hora, $segundos = false) {

                if(!$segundos) {
                    $hora = substr($hora, 0, 5);
                }
                
                return $hora;                
        }        

/**
 * Se a data for nula, usa data atual
 *
 * @param mixed $data
 * @return integer Se null, retorna a data/hora atual
 * @access protected
 */
	function _ajustaDataHora($data) {
		if (is_null($data)) {
			return time();
		}
		if (is_integer($data) || ctype_digit($data)) {
			return (int)$data;
		}
		return strtotime((string)$data);
	}

/**
 * Mostrar uma data em tempo
 *
 * @param integer $dataHora Data e hora em timestamp, dd/mm/YYYY ou null para atual
 * @param string $limite null, caso não haja expiração ou então, forneça um tempo usando o formato inglês para strtotime: Ex: 1 year
 * @return string Descrição da data em tempo ex.: a 1 minuto, a 1 semana
 * @access public
 */

	function tempo($dataHora = null, $limite = '30 days'){
		if (!$dataHora) {
			$dataHora = time();
		}

		if (strpos($dataHora, '/') !== false) {
			$_dataHora = str_replace('/', '-', $dataHora);
			$_dataHora = date('ymdHi', strtotime($_dataHora));
		} elseif (is_string($dataHora)) {
			$_dataHora = date('ymdHi', strtotime($dataHora));
		} else {
			$_dataHora = date('ymdHi', $dataHora);
		}

		if ($limite !== null) {
			if ($_dataHora > date('ymdHi', strtotime('+ ' . $limite))) {
				return $this->dataHora($dataHora);
			}
		}

		$_dataHora = date('ymdHi') - $_dataHora;
		if ($_dataHora > 88697640 && $_dataHora < 100000000) {
			$_dataHora -= 88697640;
		}

		switch ($_dataHora) {
			case 0:
				return 'menos de 1 minuto';
			case ($_dataHora < 99):
				if ($_dataHora === 1) {
					return '1 minuto';
				} elseif ($_dataHora > 59) {
					return ($_dataHora - 40) . ' minutos';
				}
				return $_dataHora . ' minutos';
			case ($_dataHora > 99 && $_dataHora < 2359):
				$flr = floor($_dataHora * 0.01);
				return $flr == 1 ? '1 hora' : $flr . ' horas';

			case ($_dataHora > 2359 && $_dataHora < 310000):
				$flr = floor($_dataHora * 0.0001);
				return $flr == 1 ? '1 dia' : $flr . ' dias';

			case ($_dataHora > 310001 && $_dataHora < 12320000):
				$flr = floor($_dataHora * 0.000001);
				return $flr == 1 ? '1 mes' : $flr . ' meses';

			case ($_dataHora > 100000000):
			default:
				$flr = floor($_dataHora * 0.00000001);
				return $flr == 1 ? '1 ano' : $flr . ' anos';

		}
	}


/**
 * Número float com ponto ao invés de vírgula
 *
 * @param float $numero Número
 * @param integer $casasDecimais Número de casas decimais
 * @return string Número formatado
 * @access public
 */
	function precisao($numero, $casasDecimais = 3) {
		return number_format($numero, $casasDecimais, ',', '.');
	}

/**
 * Valor formatado com símbolo de %
 *
 * @param float $numero Número
 * @param integer $casasDecimais Número de casas decimais
 * @return string Número formatado com %
 * @access public
 */
	function porcentagem($numero, $casasDecimais = 2) {
		return $this->precisao($numero, $casasDecimais) . '%';
	}

/**
 * Formata um valor para reais
 *
 * @param float $valor Valor
 * @param array $opcoes Mesmas opções de Number::currency()
 * @return string Valor formatado em reais
 * @access public
 */
	function moeda($valor, $opcoes = array()) {
		$padrao = array(
			'before'=> 'R$ ',
			'after' => '',
			'zero' => 'R$ 0,00',
			'places' => 2,
			'thousands' => '.',
			'decimals' => ',',
			'negative' => '-',
			'escape' => true
		);
		$config = array_merge($padrao, $opcoes);
		if ($valor > -1 && $valor < 1) {
			$before = $config['before'];
			$config['before'] = '';
			$formatado = $this->Number->format(abs($valor), $config);
			if ($valor < 0 ) {
				if ($config['negative'] == '()') {
					return '(' . $before . $formatado .')';
				} else {
					return $before . $config['negative'] . $formatado;
				}
			}
			return $before . $formatado;
		}
		return $this->Number->currency($valor, null, $config);
	}

/**
 * Valor por extenso em reais
 *
 * @param float $numero
 * @return string Valor em reais por extenso
 * @access public
 * @link http://forum.imasters.uol.com.br/index.php?showtopic=125375
 */
	function moedaPorExtenso($numero) {
		$singular = array('centavo', 'real', 'mil', 'milhão', 'bilhão', 'trilhão', 'quatrilhão');
		$plural = array('centavos', 'reais', 'mil', 'milhões', 'bilhões', 'trilhões', 'quatrilhões');

		$c = array('', 'cem', 'duzentos', 'trezentos', 'quatrocentos', 'quinhentos', 'seiscentos', 'setecentos', 'oitocentos', 'novecentos');
		$d = array('', 'dez', 'vinte', 'trinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'oitenta', 'noventa');
		$d10 = array('dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezesete', 'dezoito', 'dezenove');
		$u = array('', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove');

		$z = 0;
		$rt = '';

		$valor = number_format($numero, 2, '.', '.');
		$inteiro = explode('.', $valor);
		$tamInteiro = count($inteiro);

		// Normalizandos os valores para ficarem com 3 digitos
		$inteiro[0] = sprintf('%03d', $inteiro[0]);
		$inteiro[$tamInteiro - 1] = sprintf('%03d', $inteiro[$tamInteiro - 1]);

		$fim = $tamInteiro - 1;
		if ($inteiro[$tamInteiro - 1] <= 0) {
			$fim--;
		}
		foreach ($inteiro as $i => $valor) {
			$rc = $c[$valor{0}];
			if ($valor > 100 && $valor < 200) {
				$rc = 'cento';
			}
			$rd = '';
			if ($valor{1} > 1) {
				$rd = $d[$valor{1}];
			}
			$ru = '';
			if ($valor > 0) {
				if ($valor{1} == 1) {
					$ru = $d10[$valor{2}];
				} else {
					$ru = $u[$valor{2}];
				}
			}

			$r = $rc;
			if ($rc && ($rd || $ru)) {
				$r .= ' e ';
			}
			$r .= $rd;
			if ($rd && $ru) {
				$r .= ' e ';
			}
			$r .= $ru;
			$t = $tamInteiro - 1 - $i;
			if (!empty($r)) {
				$r .= ' ';
				if ($valor > 1) {
					$r .= $plural[$t];
				} else {
					$r .= $singular[$t];
				}
			}
			if ($valor == '000') {
				$z++;
			} elseif ($z > 0) {
				$z--;
			}
			if ($t == 1 && $z > 0 && $inteiro[0] > 0) {
				if ($z > 1) {
					$r .= ' de ';
				}
				$r .= $plural[$t];
			}
			if (!empty($r)) {
				if ($i > 0 && $i < $fim  && $inteiro[0] > 0 && $z < 1) {
					if ($i < $fim) {
						$rt .= ', ';
					} else {
						$rt .= ' e ';
					}
				} elseif ($t == 0 && $inteiro[0] > 0) {
					$rt .= ' e ';
				} else {
					$rt .= ' ';
				}
				$rt .= $r;
			}
		}

		if (empty($rt)) {
			return 'zero';
		}
		return trim(str_replace('  ', ' ', $rt));
	}
        
        function string_esquerda($str,$tam,$carac=0) {
            while(strlen($str)<$tam)
                $str = $carac.$str; 
                return $str;
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
        function formata_nome($nomecompleto, $retorna="nome", $maxtamanho=0, $exibi_msg=0) { 

            //retira os espaços consecutivos
            //$nomecompleto = utf8_encode($nomecompleto);
            $nomecompleto = preg_replace("/-/", ' ', trim($nomecompleto));
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
        
        /** 
        * Retorna o dia da semana escrito em português (dd)
        * @access public 
        * @param Int[] $dia
        * @return String[]  
        */
        function escreve_dia($dia) {

                switch($dia) { 
                        case '0' : $diaext = 'Domingo';        break; 
                        case '1' : $diaext = 'Segunda-feira';  break; 
                        case '2' : $diaext = 'Terça-feira';    break; 
                        case '3' : $diaext = 'Quarta-feira';   break; 
                        case '4' : $diaext = 'Quinta-feira';   break; 
                        case '5' : $diaext = 'Sexta-feira';    break; 
                        case '6' : $diaext = 'Sabado';         break; 
                } 
                return $diaext;
        }

        /** 
        * Retorna o dia da semana escrito em português abreviado (dd)
        * @access public 
        * @param Int[] $dia
        * @return String[]  
        */
        function escreve_dia_abrev($dia) {

                $semana = $this->escreve_dia($dia);
                return "<abbr title=\"".$semana."\" class=\"noborder\">".substr($semana,0,3)."</abbr>";
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
        * Retorna o mês escrito em português (mm)
        * @access public 
        * @param Int[] $mes
        * @return String[]  
        */
        function escreve_mes($mes) {
            while(strlen($mes)<2) {
                $mes = '0'.$mes; 
            }
                switch($mes) { 
                        case '01' : $mesext = 'Janeiro';        break; 
                        case '02' : $mesext = 'Fevereiro';      break; 
                        case '03' : $mesext = 'Março';          break; 
                        case '04' : $mesext = 'Abril';          break; 
                case '05' : $mesext = 'Maio';           break; 
                        case '06' : $mesext = 'Junho';          break; 
                        case '07' : $mesext = 'Julho';          break; 
                        case '08' : $mesext = 'Agosto';         break; 
                        case '09' : $mesext = 'Setembro';       break; 
                        case '10' : $mesext = 'Outubro';        break; 
                        case '11' : $mesext = 'Novembro';       break; 
                        case '12' : $mesext = 'Dezembro';       break;
                } 
                return $mesext;
        }

        /** 
        * Retorna o mês escrito em português abreviado (mm)
        * @access public 
        * @param Int[] $mes
        * @return String[]  
        */
        function escreve_mes_abrev($mes) {

                $mes = $this->escreve_mes($mes);
                return substr($mes,0,3);
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
    * Função retorna a data no formado americano
    * @access public 
    * @param String[] $data 
    * @return Int
    */
    function data_americana($data) { 
        if(strstr($data, "/")) {
            $data = $this->converte_data($data);
        }
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
    * Função para exibir apenas parte do texto
    * @access public 
    */ 
    function texto_limite($string,$length,$replacer='...') { 
        $string = $this->retira_acentos($string);
        if(strlen($string) > $length) {
            return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
        }
        return $string;
    }  
    
    /** 
    * Função para retirar acentuação do texto
    * @access public 
    */ 
    function retira_acentos($texto) { 
        $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç"); 
        $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C"); 
        return str_replace($array1, $array2, $texto); 
    }  
    
    /** 
    * Transforma acentuação para caracteres HTML
    * @access public 
    */ 
    function acentos_to_html($str) { 
        $caractere    = Array(       'À',       'à',       'Á',       'á',      'Â',      'â',       'Ã',       'ã',     'Ä',     'ä',      'Å',      'å',       'Ç',       'ç',       'È',       'è',       'É',       'é',      'Ê',      'ê',     'Ë',     'ë',       'Ì',       'ì',       'Í',       'í',      'Î',      'î',     'Ï',     'ï',       'Ñ',       'ñ',       'Ò',       'ò',       'Ó',       'ó',      'Ô',      'ô',       'Õ',       'õ',     'Ö',     'ö',       'Ù',       'ù',       'Ú',       'ú',      'Û',      'û',     'Ü',     'ü',       'Ý',       'ý',     'ÿ'); 
        $htmlEntidade = Array('&Agrave;','&agrave;','&Aacute;','&aacute;','&Acirc;','&acirc;','&Atilde;','&atilde;','&Auml;','&auml;','&Aring;','&aring;','&Ccedil;','&ccedil;','&Egrave;','&egrave;','&Eacute;','&eacute;','&Ecirc;','&ecirc;','&Euml;','&euml;','&Igrave;','&igrave;','&Iacute;','&iacute;','&Icirc;','&icirc;','&Iuml;','&iuml;','&Ntilde;','&ntilde;','&Ograve;','&ograve;','&Oacute;','&oacute;','&Ocirc;','&ocirc;','&Otilde;','&otilde;','&Ouml;','&ouml;','&Ugrave;','&ugrave;','&Uacute;','&uacute;','&Ucirc;','&ucirc;','&Uuml;','&uuml;','&Yacute;','&yacute;','&yuml;'); 
        $remonta = str_replace($caractere,$htmlEntidade,$str); 
        return $remonta; 
    }    
    
    /** 
    * Transforma caracteres HTML para acentuação
    * @access public 
    */ 
    function html_to_acentos($str) { 
        $caractere    = Array(       'À',       'à',       'Á',       'á',      'Â',      'â',       'Ã',       'ã',     'Ä',     'ä',      'Å',      'å',       'Ç',       'ç',       'È',       'è',       'É',       'é',      'Ê',      'ê',     'Ë',     'ë',       'Ì',       'ì',       'Í',       'í',      'Î',      'î',     'Ï',     'ï',       'Ñ',       'ñ',       'Ò',       'ò',       'Ó',       'ó',      'Ô',      'ô',       'Õ',       'õ',     'Ö',     'ö',       'Ù',       'ù',       'Ú',       'ú',      'Û',      'û',     'Ü',     'ü',       'Ý',       'ý',     'ÿ'); 
        $htmlEntidade = Array('&Agrave;','&agrave;','&Aacute;','&aacute;','&Acirc;','&acirc;','&Atilde;','&atilde;','&Auml;','&auml;','&Aring;','&aring;','&Ccedil;','&ccedil;','&Egrave;','&egrave;','&Eacute;','&eacute;','&Ecirc;','&ecirc;','&Euml;','&euml;','&Igrave;','&igrave;','&Iacute;','&iacute;','&Icirc;','&icirc;','&Iuml;','&iuml;','&Ntilde;','&ntilde;','&Ograve;','&ograve;','&Oacute;','&oacute;','&Ocirc;','&ocirc;','&Otilde;','&otilde;','&Ouml;','&ouml;','&Ugrave;','&ugrave;','&Uacute;','&uacute;','&Ucirc;','&ucirc;','&Uuml;','&uuml;','&Yacute;','&yacute;','&yuml;'); 
        $remonta = str_replace($htmlEntidade,$caractere,$str); 
        return $remonta; 
    }  
}

