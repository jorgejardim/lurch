<?php 
if($session->check('menu_data')) {
    echo $tree->setup($session->read('menu_data'), array('selected' => $this->here)); 
}
?>