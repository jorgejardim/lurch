<?php

/**
 * Força o CakePHP a utilizar campos do tipo "enum" como comboboxes (select)
 *
 * @author gino pilotino (gunzip)
 * @modifiedBy Lucas Pelegrino <lucas_wxp@hotmail.com>
 *
 * @link http://bakery.cakephp.org/articles/view/baked-enum-fields-reloaded
 * @link http://lucaspelegrino.com/
 *
 * @example Apenas coloque em no controller o componente Enum:
 *  1 -
 *      class AppController extends Controller {
 *          var $components = array('Enum');
 *      }
 *
 *  Ou se você quiser que tenha efeito em um controller exclusivo:
 *
 * 2 -
 *      class MeuController extends AppController {
 *          var $components = array('Enum');
 *      }
 *
 */
class EnumComponent extends Object {

    function startup(&$controller) {
        foreach ($controller->modelNames as $model) {
            foreach ($controller->$model->_schema as $var => $field) {
                if (strpos($field['type'], 'enum') === FALSE)
                    continue;

                preg_match_all("/\'([^\']+)\'/", $field['type'], $strEnum);

                if (is_array($strEnum[1])) {
                    $varName = Inflector::camelize(Inflector::pluralize($var));
                    $varName[0] = strtolower($varName[0]);
                    $controller->set($varName, array_combine($strEnum[1], $strEnum[1]));
                }
            }
        }
    }
}
?>