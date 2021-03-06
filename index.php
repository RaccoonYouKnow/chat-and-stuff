<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_functions.php';

if ( @isset($_POST['message']) ) {
  $msg = db_quote($_POST['message']);
  $name = db_quote($_POST['firstname']);
  $cookie_name = "name";
  $cookie_value = $_POST['firstname'];
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  db_query("INSERT INTO `messages` (message, user) VALUES (" . $msg . ", ".$name.")");
  header('Location: '.$_SERVER['PHP_SELF']);
  die;
}

$size = 10;
if ( @isset($_GET['size']) ) {
  $size = escape($_GET['size']);
}

$rows = db_select("SELECT user, message, dateandtime FROM messages order by dateandtime desc limit " . $size);
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles.css?<?php echo rand() ?>">
  <title>Crapchat</title>
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="img/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="img/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="img/favicon-128.png" sizes="128x128" />
<meta name="application-name" content="Crapchat"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="img/mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="img/mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="img/mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="img/mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="img/mstile-310x310.png" />

</head>
<body>
<div id="header">
  <h1><img src="img/crapchat.png" width="300" height="150"  alt="crapchat"></h1>
  <h2 class="tagline">Tjöta med irriterande människor!</h2>
</div>
<FORM>
<INPUT id="a2"TYPE="button" width="300" height="150" onClick="history.go(0)" VALUE="ladda om sidan!">
</FORM>
<?php
foreach ($rows as $row) {
  $mess = $row['message'];

  $mess = str_replace(":)", "<img width=\"25\" height=\"25\" src=\"http://emojione.com/wp-content/uploads/assets/emojis/1f600.svg\">" , $mess);
  $mess = str_replace("<script", "INTE HACKA!" , $mess);
$row['user'] = str_replace(":)", "<img width=\"25\" height=\"25\" src=\"http://emojione.com/wp-content/uploads/assets/emojis/1f600.svg\">" , $row['user']);
$mess = str_replace("Raccoon", "<img width=\"25\" height=\"25\" src=\"https://upload.wikimedia.org/wikipedia/commons/e/ed/Raccoon_(Procyon_lotor)_2.jpg\">" , $mess);
$row['user'] = str_replace("Raccoon", "<img width=\"25\" height=\"25\" src=\"https://upload.wikimedia.org/wikipedia/commons/e/ed/Raccoon_(Procyon_lotor)_2.jpg\">" , $row['user']);

echo "<div>" . $mess ." <br> ". $row['user'] ."<br>".$row['dateandtime']. " <br> <br> </div>";

}
?>

  <h2>Klockan är nu <br> <?php echo date('Y-m-d H:i:s') ?></h2>

<form method="post" >
  <textarea name="message" action="form1.php" rows="10" cols="30"></textarea><br>
  Namn: <input type="text" name="firstname" value="<?php
  if (@isset($_COOKIE["name"])) {
    echo $_COOKIE["name"];
  }
?>">

  <input type="submit"  value="Skicka!">
</form>

<p> Gjord utav Kasper med viss hjälp av Pål! No rights reserved!</p>

<p>Visar de <?php echo $size ?> senaste inläggen</p>

<?php
echo rand() . "\n";
?>


</body>
</html>
