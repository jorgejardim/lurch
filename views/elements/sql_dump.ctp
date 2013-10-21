<?php
/**
 * SQL Dump element.  Dumps out SQL log information 
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.elements
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (!class_exists('ConnectionManager') || Configure::read('debug') < 2) {
    return false;
}
$noLogs = !isset($logs);
if ($noLogs):
    $sources = ConnectionManager::sourceList();

    $logs = array();
    foreach ($sources as $source):
        $db = & ConnectionManager::getDataSource($source);
        if (!$db->isInterfaceSupported('getLog')):
            continue;
        endif;
        $logs[$source] = $db->getLog();
    endforeach;
endif;

if ($noLogs || isset($_forced_from_dbo_)):
    foreach ($logs as $source => $logInfo):
        $text = $logInfo['count'] > 1 ? 'queries' : 'query';
        printf(
                '<div class="cake-debug-log"><div class="cake-debug-title"><strong>debug</strong></div><div class="cake-debug-sub-title">SQL:</div><table class="cake-sql-log" id="cakeSqlLog_%s" summary="Cake SQL Log" cellspacing="0" border = "0">', preg_replace('/[^A-Za-z0-9_]/', '_', uniqid(time(), true))
        );
        printf('<caption>(%s) %s %s took %s ms</caption>', $source, $logInfo['count'], $text, $logInfo['time']);
        ?>
        <thead>
            <tr><th>Nr</th><th>Query</th><th>Error</th><th>Affected</th><th>Num. rows</th><th>Took (ms)</th></tr>
        </thead>
        <tbody>
            <?php
            foreach ($logInfo['log'] as $k => $i) :
                echo "<tr><td>" . ($k + 1) . "</td><td>" . h($i['query']) . "</td><td>{$i['error']}</td><td style = \"text-align: right\">{$i['affected']}</td><td style = \"text-align: right\">{$i['numRows']}</td><td style = \"text-align: right\">{$i['took']}</td></tr>\n";
            endforeach;
            ?>
        </tbody></table>
        <?php
    endforeach;
else:
    echo '<p>Encountered unexpected $logs cannot generate SQL log</p>';
endif;

echo '<div class="cake-sql-log-2">';
echo '<div><span class="cake-pre-log">Params:</span>';
echo '<pre>';
print_r($this->params);
echo '</pre></div>';
echo '<div><span class="cake-pre-log">Sessions:</span>';
echo '<pre>';
print_r($this->Session->read());
echo '</pre></div>';
echo '<div><span class="cake-pre-log">Server:</span>';
echo '<pre>';
print_r($_SERVER);
echo '</pre></div>';
echo '<div><span class="cake-pre-log">Post:</span>';
echo '<pre>';
print_r($_POST);
echo '</pre></div>';
echo '<div><span class="cake-pre-log">Get:</span>';
echo '<pre>';
print_r($_GET);
echo '</pre></div>';
echo '<div><span class="cake-pre-log">Constants:</span>';
echo '<pre>';
$constants = get_defined_constants(true);
print_r($constants['user']);
echo '</pre></div>';
echo '<div><span class="cake-pre-log">Conteudo:</span>';
echo '<pre>';
print_r(@$conteudo);
echo '</pre></div>';
echo '</div>';
echo '</div>';
?>
<style>
.cake-pre-log pre, .cake-sql-log, .cake-debug-sub-title, .cake-sql-log-2, .cake-sql-log-2 div pre { display:none; text-align: center; }   
.cake-debug-title, .cake-debug-sub-title { cursor: pointer; text-align: center; }
.cake-debug-title:hover, .cake-debug-sub-title:hover { background-color: #FFC080 }
.cake-pre-log { text-align: center; background-color: transparent; cursor: pointer; }
.cake-pre-log:hover { background-color: #FFC080 }
pre { text-align: left !important; }

</style>
<script>
$(document).ready(function() {
    $(".cake-pre-log").click(function () {
        $(this).parent().find('pre').toggle();
    });
    $(".cake-debug-title").click(function () {
        $(".cake-debug-sub-title").toggle();
        $(".cake-sql-log-2").toggle();
    });
    $(".cake-debug-sub-title").click(function () {
        $(".cake-sql-log").toggle();
    });
});    
</script>