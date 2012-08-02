<?php

if (!isset($initHtml)) include_once '../inc/html.php';
include_once $root . 'inc/io.php';

$title = 'Autologin [cselian]';
$qs = isset($_GET['file']) ? '&file=' . $_GET['file'] : '';
$content = '<a class="right" href="?admin=1' . $qs . '">&hellip;</a>
      <h2>Cselian.com Autologin</h2>
      <hr />
';

$extracss = '.multiform input[type=submit] { margin-left: 20px; }';

function login_p($link, $return = 1)
{
  $res = sprintf('<form class="multiform" action="%s" method="post" target="%s"><br/><strong>%s</strong>', $link[0], $link[1], $link[1]);
  $fields = explode(",", $link[2]);
  foreach ($fields as $f)
  {
    $nv = explode("=", $f);
    $res .= sprintf('<input name="%s" value="%s" type="hidden" />', $nv[0], $nv[1]);
  }
  $res .= '<input value="Submit" type="submit" /></form>';
  if ($return) return $res; else echo $res;
}

$txts = get_files('./', '.txt');
if (count($txts) > 1)
{
  $content .= '<strong>Data Files</strong>: ';
  foreach ($txts as $v) $content .= link_p('./?file=' . $v, $v);
  $content .= '<hr/>';
}

$fil = isset($_GET['file']) ? $_GET['file'] . '.txt' : './default.txt';

if (isset($_POST['txt']))
{
  file_put_contents($fil, $_POST['txt']);
  $c = file_exists($fil) ? file_get_contents($fil) : "";
  $content .= '<div id="info">Links Saved</div>';
}
if ($_GET['admin'])
{
  $qs = isset($_GET['file']) ? '?file=' . $_GET['file'] : '';
  $plain = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $qs;
  $c = file_exists($fil) ? file_get_contents($fil) : "";
  $content .= sprintf('Format:<pre>#Section
Url|Text|name=value,name=value</pre>
<form method="post" action="%s"><textarea rows="20" cols="80" name="txt">%s</textarea><br/>
  <input type="submit" /></form>', $plain, $c);
}
else if (file_exists($fil))
{
  $txt = file($fil);
  $first = 1;
  foreach ($txt as $lin) {
    if ($lin == "") continue;
    if ($lin[0] == '#')
    {
      if (!$first) $content .= '<br/>'; $first = 0;
      $content .= sprintf("<strong>%s</strong>:", substr($lin, 1));
    }
    else
    {
      $content .= login_p(explode("|", $lin));
    }
  }
  //dump($txt);
}
else
{
  $admin = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?admin=1';
  $content .= link_p($admin, 'admin');
}

include '../links/template.php';
?>
