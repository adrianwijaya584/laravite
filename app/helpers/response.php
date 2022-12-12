<?php

  function OK($message= "", $data= []) {
    $json= [
      "success"=> true,
      "message"=> $message,
      "data"=> $data
    ];

    return response()->json($json, 200);
  }

  function NOT_FOUND($message="", $data=[]) {
    $json= [
      "success"=> false,
      "message"=> $message,
      "data"=> $data
    ];

    return response()->json($json, 404);
  }
?>