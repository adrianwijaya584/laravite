<?php

use Illuminate\Support\MessageBag;

function parseErrorMessage(MessageBag $error) {
  $result= [];

  $error= json_decode($error);

  foreach ($error as $key => $value) {
    array_push($result, $value[0]);
  }

  return $result;
}

?>