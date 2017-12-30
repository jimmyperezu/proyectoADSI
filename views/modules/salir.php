<?php  

if(!isset($_SESSION)){
	session_start();
}

session_destroy();
// if (headers_sent()) {

// }else{
	
// }

header("location:index.php?action=index");


?>