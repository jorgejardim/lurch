<?php
/* Convidado Fixture generated on: 2013-05-29 20:14:35 : 1369869275 */
class ConvidadoFixture extends CakeTestFixture {
	var $name = 'Convidado';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'evento_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'nome' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'celular' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'qtd_convidados' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'comment' => '0:aguardando - 1:confirmado - 2:nao vai'),
		'qtd_confirmados' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'confirmados' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'evento_id' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'celular' => 'Lorem ipsum d',
			'qtd_convidados' => 1,
			'status' => 1,
			'qtd_confirmados' => 1,
			'confirmados' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2013-05-29 20:14:35',
			'modified' => '2013-05-29 20:14:35'
		),
	);
}
