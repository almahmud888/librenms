<?php

require 'includes/graphs/common.inc.php';

$scale_min    = 0;
$colours      = 'blue';
$nototal      = (($width < 224) ? 1 : 0);
$unit_text    = 'Inbound Calls/sec';
$rrd_filename = rrd_name($device['hostname'], array('app', 'freeswitch', 'stats', $app['app_id']));
$array        = array(
                 'in_okay'  => array(
                               'descr'  => 'Okay',
                               'colour' => '008800FF',
                              ),
                 'in_failed' => array(
                               'descr'  => 'Failed',
                               'colour' => '880000FF',
                              ),
                );

$i = 0;

if (rrdtool_check_rrd_exists($rrd_filename)) {
    foreach ($array as $ds => $vars) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr']    = $vars['descr'];
        $rrd_list[$i]['ds']       = $ds;
        $rrd_list[$i]['colour']   = $vars['colour'];
        $i++;
    }
} else {
    echo "file missing: $file";
}

require 'includes/graphs/generic_multi_simplex_seperated.inc.php';