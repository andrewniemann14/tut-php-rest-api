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
    return parse_str($_SERVER['QUERY_STRING'], $query);
  }

  protected function sendOutput($data, $httpHeaders=array()) {
    header_remove('Set-Cookie');

    if (is_array($httpHeaders) && count($httpHeaders)) {
      foreach($httpHeaders as $httpHeader) {
        header($httpHeader);
      }
    }

    echo $data;
    exit(); // TODO: no parentheses in tutorial...
  }
}