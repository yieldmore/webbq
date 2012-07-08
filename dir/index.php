<?php

if (!isset($initHtml)) include_once '../inc/html.php';

if (!isset($homeFol)) $homeFol = "../../"; // because running in webbq subdirectory

if (file_exists('./local.php'))
{
  include './local.php';
}
else
{
  // Folders to exclude
  $exclude = array(null, 'xampp', '.git', 'inc');
  
  // When it encounters a folder with the given name, it appends the text for the link.
  // if its an array, it does this for each item.
  $suffix = array('webbq' => 'dir');
}

if (!isset($title)) $title = 'PHP Hosted Apps [cselian]';
$content = '<a class="right" href="#">&hellip;</a>
      <h2>' . (isset($heading) ? $heading : 'Directory of ' . $homeFol) . '</h2>
      <hr />
';
$home  = opendir($homeFol);

while (false !== ($item = readdir($home)))
{
  if ($item == "." || $item == "..") continue;
  
  if (!is_dir($homeFol . $item) || array_search($item, $exclude)) continue;
  
  $lnk = array($item);
  if (isset($suffix[$item]))
  {
    if (is_array($suffix[$item]))
    {
      $lnk = array();
      foreach ($suffix[$item] as $i) $lnk[] = $item . '/' . $suffix[$item];
    }
    else
    {
      $lnk[0] = $item . '/' . $suffix[$item];
    }
  }
  foreach ($lnk as $l)
    $content .= sprintf('      <a href="%s%s">%s</a>
', $homeFol, $l, $item);
}

include $root . 'links/template.php';
?>
