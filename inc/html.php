<?php
$initHtml = 1;
if (!isset($root)) $root = '../';
function dump($obj, $die = 0)
{
  echo '<pre>' . print_r($obj, 1) . '</pre>';
  if ($die) die();
}

function link_p($link, $txt = null, $return = 1)
{
  if (is_array($link)) { $txt = $link[1]; $link = $link[0]; }
  if ($txt == null || $txt == "") $txt = $link;
  $res = sprintf('      <a href="%s">%s</a>', $link, $txt);
  if ($return) return $res; else echo $res;
}

function link_home($return = 0)
{
  
}
?>
