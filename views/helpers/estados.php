<?php
/**
 * Helper para exibir os estados brasileiros
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Estado Helper
 *
 * @link http://wiki.github.com/jrbasso/cake_ptbr/helper-estados
 */
class EstadosHelper extends AppHelper {

/**
 * Helpers auxiliares
 *
 * @var array
 * @access public
 */
	var $helpers = array('Form');

/**
 * Retorna a select com a lista dos estados
 *
 * @param string $fieldName Nome do campo
 * @param string $selected Sigla do estado que deve ser selecionado
 * @param array $attributes Mesmos atributos do Form::select(). Também é possível passar o param
				'uf' para mostrar apenas as siglas, sem os nomes
 */
	function select($fieldName, $attributes = array()) {
		App::import('Vendor', 'Estados');
		$options = Estados::lista();
		if (isset($attributes['uf']) && $attributes['uf'] === true) {
			$estados = array_keys($options);
			$options = array_combine($estados, $estados);
			unset($attributes['uf']);
		}
		if (!isset($attributes['empty'])) {
			$attributes['empty'] = false;
		}

                $attr = array(
                        'options'=>$options,
                        'class'=>'estado',
                        'type'=>'select'
                    );
                
                if(!empty($attributes)) {
                    $attr = array_merge($attr, $attributes);
                }
                
                return $this->Form->input($fieldName, $attr);
	}
}
