<?php

if (!isset($initHtml)) include_once '../inc/html.php';
include_once $root . 'inc/io.php';

$title = 'Links Dashboard [cselian]';
$content = '<a class="right" href="?admin=1">&hellip;</a>
      <h2>Cselian.com Web</h2>
      <hr />
';

$txts = get_files('./', '.txt');
if (count($txts) > 1)
{
  $content .= 'Data Files: ';
  foreach ($txts as $v) $content .= link_p('./?file=' . $v, $v);
  $content .= '<hr/>';
}

$fil = isset($_GET['file']) ? $_GET['file'] . '.txt' : "./default.txt";

if (isset($_POST['txt']))
{
  file_put_contents($fil, $_POST['txt']);
  $c = file_exists($fil) ? file_get_contents($fil) : "";
  $content .= '<h5>Links Saved</h5>';
}
if ($_GET['admin'])
{
  $plain = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
  $c = file_exists($fil) ? file_get_contents($fil) : "";
  $content .= sprintf('Format:<pre>#Section
Url|Text</pre>
<form method="post" action="%s"><textarea rows="20" cols="80" name="txt">%s</textarea><br/>
  <input type="submit" /></form>', $plain, $c);
}
else if (file_exists($fil))
{

  $txt = file($fil);
  foreach ($txt as $lin) {
    if ($lin == "") continue;
    if ($lin[0] == '#')
    {
      $content .= sprintf("<h3>%s</h3>", substr($lin, 1));
    }
    else
    {
      $content .= link_p(explode("|", $lin));
    }
  }
  //dump($txt);
}
else
{
  $admin = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?admin=1';
  $content .= link_p($admin, 'admin');
}

include 'template.php';
?>
