<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_functions.php';

if ( @isset($_GET['message']) ) {
  $msg = db_quote($_GET['message']);
  $name = db_quote($_GET['firstname']);
  db_query("INSERT INTO `messages` (message, user) VALUES (" . $msg . ", ".$name.")");
}

$rows = db_select("SELECT user, message, dateandtime FROM messages order by dateandtime desc limit 10 ");

?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles.css?<?php echo rand() ?>">
</head>
<body>
<div id="header">
  <h1>text </h1> <img src= >
  <h2 class="tagline">Tjöta med irriterande människor!</h2>
</div>
<?php
foreach ($rows as $row) {
  echo "<div>" . $row['message'] ." <br> ". $row['user'] ."-".$row['dateandtime']. " <br> <br> </div>";
}
?>
  <h2>Klockan är nu <br> <?php echo date('Y-m-d H:i:s') ?></h2>
<form>
  <textarea name="message" rows="10" cols="30"></textarea><br>
  Namn: <input type="text" name="firstname">
  <input type="submit" value="Skicka!">
</form>
<p> Gjord utav Kasper med viss hjälp av Pål! No rights reserved!</p>
<?php
echo rand() . "\n";
?>
</body>
</html>
