<?php
$filename = 'MadelineProto.log';  //about 500MB
$output = shell_exec('exec tail -n1 ' . $filename);  //only print last 50 lines
echo str_replace(PHP_EOL, '<br />', $output);         //add newlines
?><?php
