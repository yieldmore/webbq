<?php

if (!isset($initHtml)) include_once '../inc/html.php';
include_once $root . 'inc/io.php';

$title = 'Biorhythm [cselian]';
$qs = isset($_GET['file']) ? '&file=' . $_GET['file'] : '';
$content = '<a class="right" href="?admin=1' . $qs . '">&hellip;</a>
      <h2>Cselian.com Biorhythm<a style="width: auto;" href="http://en.wikipedia.org/wiki/Biorhythm">...</a></h2>
      <hr />
';

$extracss = '.multiform input[type=submit] { margin-left: 20px; }
.multiform strong { font-weight: normal; }';

function name_p($link, $fil)
{
  return link_p(sprintf('?name=%s&dob=%s&file=%s', $link[0], $link[1], $fil), $link[0]);
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

$admin = 0;
if ($_GET['admin'])
{
  $admin = 1;
  $qs = isset($_GET['file']) ? '?file=' . $_GET['file'] : '';
  $plain = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $qs;
  $c = file_exists($fil) ? file_get_contents($fil) : "";
  $content .= sprintf('Format:<pre>#Section
Name|DOB (DD/MM/YYYY)</pre>
<form method="post" action="%s"><textarea rows="20" cols="80" name="txt">%s</textarea><br/>
  <input type="submit" /></form>', $plain, $c);
}

if (!$admin && $_GET['name'])
{
  $date = explode("-", $_GET['dob']);
  $chart .= sprintf("<!-- 

You can format the output text by defining styles
for: H1, H2, H3, p, th, input, select and body in a CSS
style sheet. See: http://www.w3.org/Style/CSS/

This code and output may not be changed
without written permission

-->
<!-- Biorhythm Calculator - Begin -->
<!-- http://biorhythms.perbang.dk -->

<script type='text/javascript' src='http://biorhythms.perbang.dk/page.biorhythms/?js=1&d=%s&m=%s&y=%s&name=%s&t=12&min=37&z=1&phy=1&emo=1&inte=1&spi=1&awa=1&aes=1&intu=1&lang=en'></script><noscript><a href='http://www.procato.com/biorhythm/'>Free Biorhythms</a></noscript>

<!-- Biorhythm Calculator - End -->", $date[0], $date[1], $date[2], $_GET['name']);

}


if (!$admin && file_exists($fil))
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
      $content .= name_p(explode("|", $lin), $_GET['file']);
    }
  }
  $content .= $chart;
  //dump($txt);
}
else if (!$admin)
{
  $admin = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?admin=1';
  $content .= link_p($admin, 'admin');
}

include '../links/template.php';
?>
