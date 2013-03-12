<?php
$dir = dirname(__FILE__);
$files = scandir('../posts/');
foreach($files as $file) {
  echo $file;
}
?>