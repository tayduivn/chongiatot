<?php
require_once(dirname(dirname(__FILE__)) . '/app.php');
$daytime = strtotime(date('Y-m-d H:i:s'));
$condition = array(
	'team_type' => 'normal',
	'city_id' => array(0, abs(intval($city['id']))),
	"begin_time > '{$daytime}'",
);

if (!option_yes('displayfailure')) {
	$condition['OR'] = array(
		"now_number >= min_number",
		"end_time > '{$daytime}'",
	);
}
$group_id = abs(intval($_GET['gid']));
if ($group_id) $condition['group_id'] = $group_id;

$count = Table::Count('team', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 10);
$teams = DB::LimitQuery('team', array(
	'condition' => $condition,
	'order' => 'ORDER BY begin_time DESC, sort_order DESC, id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));
foreach($teams AS $id=>$one){
	team_state($one);
	if (!$one['close_time']) $one['picclass'] = 'isopen';
	if ($one['state']=='soldout') $one['picclass'] = 'soldout';
	$teams[$id] = $one;
}

$category = Table::Fetch('category', $group_id);
$pagetitle = 'Sự kiện giảm giá';
include template('team_event');

function current_teamcategory($gid='0') {
	global $city;
	$a = array(
			'/su-kien-giam-gia.html' => 'Tất cả',
			);
	foreach(option_hotcategory('group') AS $id=>$name) {
		$a["/team/index.php?gid={$id}"] = $name;
	}
	$l = "/team/index.php?gid={$gid}";
	if (!$gid) $l = "/team/index.php";
	return current_link($l, $a, true);
}