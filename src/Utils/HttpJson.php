<?php

namespace Ereto\Utils;

use DateTime;

class HttpJson {

  static function Json(string $msg = "", int $http, $more = null) {
    http_response_code($http);
    $date = new DateTime();
    $arr = array(
      "message" => $msg,
      "http_code" => $http,
      "date" => $date->format("d-m-yy h:m:s"),
      "more" => $more
    );

    return print(json_encode($arr, JSON_PRETTY_PRINT));
  }
}
