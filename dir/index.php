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
  
  if (isset($suffix[$item]))
  {
    if (is_array($suffix[$item]))
    {
      $lnk = array();
      foreach ($suffix[$item] as $i)
        $content .= link_p($homeFol . $item . '/' . $i, $i);
    }
    else
    {
      $content .= link_p($homeFol . $item . '/' . $suffix[$item], $item);
    }
  }
  else
  {
    $content .= link_p($homeFol . $item, $item);
  }
}

include $root . 'links/template.php';
?>
