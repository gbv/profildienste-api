<?php

namespace Responses;


class BasicResponse extends APIResponse {

  public function __construct($data) {
    $this->data = $data;
  }

  public function getData() {
    return $this->data;
  }
}