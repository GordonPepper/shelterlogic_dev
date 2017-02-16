<?php
if (!isset($_GET['autho'])) { die("You are not privilaged enough to see whats behind door number one so stop!"); }
if ($_GET['autho'] !== md5('BryanBielefeldt2015YeahBitches')) { die("If you dont know what you are doing stop! You are treading on thin ice dude!!!"); }

$files = glob('images/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

?>