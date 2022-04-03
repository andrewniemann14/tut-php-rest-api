<?php

class BaseController {
  public function __call($name, $arguments) {
    $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
  }

  // gets URI, returns array
  protected function getUriSegment() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);
    
    return $uri;
  }
  
  // gets query params, returns array
  protected function getQueryStringParams() {
    $qryStrSplit = explode('?', $_SERVER['QUERY_STRING']);
    $queryParams = array();
    foreach ($qryStrSplit as $q) {
      $pair = explode('=', $q);
      $queryParams[$pair[0]] = $pair[1];
    }
    return $queryParams;
  }

//   $queryParams = explode('?', $_SERVER['QUERY_STRING']);
// $queries = array();
// foreach ($queryParams as $q) {
//   $pair = explode('=', $q);
//   $queries[$pair[0]] = $pair[1];
// }

  protected function sendOutput($data, $httpHeaders=array()) {
    header_remove('Set-Cookie');

    if (is_array($httpHeaders) && count($httpHeaders)) {
      foreach($httpHeaders as $httpHeader) {
        header($httpHeader);
      }
    }

    echo $data;
    exit();
  }
}