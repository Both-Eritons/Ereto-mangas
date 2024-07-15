<?php

namespace Ereto\Utils;

use DateTime;
use Psr\Http\Message\ResponseInterface as Response;

class HttpJson
{

  static function Json(Response $res, string $msg = "", int $http, $more = null): Response
  {

    $date = new DateTime();
    $arr = array(
      "message" => $msg,
      "http_code" => $http,
      "date" => $date->format("d-m-yy h:m:s"),
      "more" => $more
    );

    $payload = json_encode($arr);
    $res->withStatus($http)->getBody()->write($payload);

    return $res->withHeader("Content-type", "application/json");
  }
}
