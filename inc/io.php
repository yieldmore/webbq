<?php
// File and Directory operations
// Similar to the System.IO .Net namespace
include_once $root . 'inc/string.php';

function get_files($fol, $extension = '*', $extn = 0)
{
  $res = array();
  $dir  = opendir($fol);

  while (false !== ($item = readdir($dir)))
  {
    if ($item == "." || $item == "..") continue;
    if (is_dir($fol . $item)) continue;
    
    if ($extension != '*' && !endsWith($item, $extension)) continue;
    
    if (!$extn) $item = preg_replace("/\\.[^.\\s]{3,4}$/", "", $item);
    $res[] = $item;
  }

  return $res;
}
?>
