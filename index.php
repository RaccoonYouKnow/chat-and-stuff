<?php require 'db_functions.php'; ?>

<?php

if ( @isset($_GET['message']) ) {
  $msg = db_quote($_GET['message']);
  $name = db_quote($_GET['firstname']);
  db_query("INSERT INTO `messages` (message, user) VALUES (" . $msg . ", ".$name.")");
}

$rows = db_select("SELECT user, message, dateandtime FROM messages order by dateandtime desc limit 10 ");

?>

<html>
<head>
  <link rel="stylesheet" href="styles.css?<?php echo rand() ?>">
</head>
<body>
  <h1>Överlägset chattprogram!</h1> <img src= >
  <h2>Chatta med irriterande människor!</h2>

<?php
//var_dump($rows);
foreach ($rows as $row) {

  echo "<div>" . $row['message'] ." <br> ". $row['user'] ."-".$row['dateandtime']. " <br> <br> </div>";
  //print_r ($rows) ;
    //echo " $ <br>";
}
?>

  <h2>Klockan är nu <?php echo date('Y-m-d H:i:s') ?></h2>
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
