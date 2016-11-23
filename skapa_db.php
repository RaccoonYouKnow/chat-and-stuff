<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_functions.php';
$result = db_query("CREATE TABLE `messages` (`dateandtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,`message` text NOT NULL,`user` varchar(100) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
?>
Skapa databas svarade <?php echo $result ?>.
