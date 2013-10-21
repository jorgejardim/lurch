<?php
/* Menu Fixture generated on: 2011-12-05 17:54:32 : 1323114872 */
class MenuFixture extends CakeTestFixture {
	var $name = 'Menu';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'link' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'group_id' => 1,
			'parent_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'link' => 'Lorem ipsum dolor sit amet',
			'lft' => 1,
			'rght' => 1,
			'active' => 1
		),
	);
}
