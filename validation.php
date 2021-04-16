<?php

$name =  $_POST['name'];
$date =  $_POST['date'];
$time =  $_POST['time'];

if(!$name) {
  $errors[] = 'Event name is required';
}

if(!$date) {
  $errors[] = 'Event date is required';
}

if(!$time) {
  $errors[] = 'Event time is required';
}
