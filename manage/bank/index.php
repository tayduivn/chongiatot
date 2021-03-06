<?php
/**
 * show thong tin chuyen khoan cua khach hang
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
need_auth('admin');
// get someing from where ...?
$order_code = strval($_GET['order_code']);
$bank_number = strval($_GET['bank_number']);
$tel = abs(intval($_GET['tel']));
$fromday	=	abs(intval($_GET['fromday']));
$today	=	abs(intval($_GET['today']));
$process	=	abs(intval($_GET['process']));

$condition = array();


if($order_code){
	$condition[] = "code like '%".mysql_escape_string($order_code)."%'";
}
if($bank_number){
	$condition[] = "bank_number like '%".mysql_escape_string($bank_number)."%'";
}
if($tel){
	$condition[] = "tel like '%".mysql_escape_string($tel)."%'";
}
if($fromday){
	$fromtime	=	strtotime($fromday);
	$condition[] = "create_time >= '{$fromtime}'";
}
if($today){
	$totime	=	strtotime($today);
	$condition[] = "create_time <= '{$totime}'";
}
if($fromday && $today){
	$condition[] = "create_time >= '{$fromday}' and create_time <= '{$today}'";
}


$count = Table::Count('payment', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$payments = DB::LimitQuery('payment', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));


$bank_ids = Utility::GetColumn($payments, 'bank_id');
$banks = Table::Fetch('bank', $bank_ids);
foreach($banks AS $id=>$one){
	$banks[$id] = $one;
}


include template('manage_bank_index');

?>