<?php

require 'includes/html/graphs/common.inc.php';
$i = 0;
$scale_min = 0;
$nototal = 1;
$unit_text = 'Per Sec.';
$rrd_filename = rrd_name($device['hostname'], ['app', 'freeradius-access', $app['app_id']]);
$fr_access_array = [
    'requests' => 'Requests',
    'accepts' => 'Accepts',
    'rejects'=> 'Rejects',
    'challenges' => 'Challenges',
];
$colours = 'mixed';
$rrd_list = [];
if (rrdtool_check_rrd_exists($rrd_filename)) {
    foreach ($fr_access_array as $ds => $descr) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr'] = $descr;
        $rrd_list[$i]['ds'] = $ds;
        $i++;
    }
} else {
    echo "file missing: $rrd_filename";
}
require 'includes/html/graphs/generic_multi_line.inc.php';
