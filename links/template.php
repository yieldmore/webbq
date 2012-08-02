<?php if (isset($content) == false) die("Direct script access not allowed"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1250">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <title><?php echo $title; ?></title>
    <style type="text/css">
/*<![CDATA[*/
    <!--
body { margin: 20px; font: bold 18px bold verdana; background-color: #cccc99; }
#footer { font-size: 12pt; }
h2 { font-size: 22px; text-transform: uppercase; letter-spacing: 4px; margin: 0px; }
#sites { margin: 0px 200px 0px 200px; background-color: #ffe; padding: 10px 50px 10px 50px; }
#sites a { background-color: #99cccc; letter-spacing: 2px; 
  width: 80px; display: inline-block; padding: 2px 10px 2px 10px; margin: 5px; }
#sites strong{ width: 120px; display: inline-block; text-align: right; }
#sites a.right, #footer a { margin: 0px; padding: 2px; background-color: transparent; width: auto; }
#sites a.right { float: right; } #footer a { color: #336699; }
a, a:visited { color: #da3838; text-decoration: none; }
a:hover { background-color: #ffcc99!important; }
#info { background-color: #99ff99; border: 1px #006600 solid; padding: 6px; }
<?php echo isset($extracss) ? $extracss . "\r\n" : ""; ?>    //-->
    /*]]>*/
    </style>
  </head>
  <body>
    <div id="sites">
      <?php echo $content; ?>
      <hr />
      <div id="footer">
       &copy; <?php echo date('Y'); ?> <a href="http://github.com/ImranCS/webbq/">cselian.com</a> |
       <?php link_home(0); ?>
      </div>
    </div>
  </body>
</html>
