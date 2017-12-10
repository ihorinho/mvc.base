<?php

function dump($data, $die = true){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
  if($die){
      die;
  }
}

function clearString($string){
    return trim(strip_tags($string));
}