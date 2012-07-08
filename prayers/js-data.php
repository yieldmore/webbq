<?php
// todo: Support word admin, colours and other effects.

Header("content-type: application/x-javascript");

$content = 'var pyrData = new Array(
';

$fil = isset($_GET['file']) ? $_GET['file'] . '.txt' : './default.txt';

if (!file_exists($fil))
{
  die(file_get_contents('prayers.js'));
}
$txt = file($fil);
$lines = array();

foreach ($txt as $lin)
  $lines[] = sprintf('	"<li>%s</li>"', trim($lin));

$content .= implode(',
', $lines) . ');
';

echo $content;
?>
