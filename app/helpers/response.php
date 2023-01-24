<?php

  function OK($message= "", $data= []) {
    $json= [
      "success"=> true,
      "message"=> $message,
      "data"=> $data
    ];

    return response()->json($json, 200);
  }

  function FORBIDDEN($data= []) {
    $json= [
      "success"=> false,
      "message"=> "aksi dilarang dilakukan.",
      "data"=> $data
    ];

    return response()->json($json, 403);
  }

  function NOT_FOUND($message="", $data=[]) {
    $json= [
      "success"=> false,
      "message"=> $message,
      "data"=> $data
    ];

    return response()->json($json, 404);
  }

  function INTERNAL_SERVER_ERROR($data=[]) {
    $json= [
      "success"=> false,
      "message"=> "terjadi kesalahan di server.",
      "data"=> $data
    ];

    return response()->json($json, 500);
  }
