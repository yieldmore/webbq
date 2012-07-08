<html>
<head>
<title>Prayers</title>
<script type="text/javascript" src="ghosts.js"></script>
<?php $qs = isset($_GET['file']) ? '?file=' . $_GET['file'] : '';?>
<script src="js-data.php<?php echo $qs; ?>" type="text/javascript"></script>
<style type="text/css">
<!--
body { background-color: #ccc; cursor: default; }
li { padding: 2px; list-style-type: none; font-size: large; 
background-color: #80A5E1; 
-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px; }
//-->
</style>
</head>
<body>

<script type="text/javascript">
  Halloween.ghostImages = pyrData;
  Halloween.interval = 150;
  
  Halloween.ghostOutput();
  Halloween.ghostLoad=window.onload;
  window.onload=Halloween.ghostStart;
</script>
</body> 
</html>
