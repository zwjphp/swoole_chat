<?php

namespace app\common\excension;

use think\exception\Handle;
use think\Response;

class Http extends Handle
{
  private $msg = NULL;
  private $status = NULL;

  public function render($request, \Throwable $e): Response
  {

    $this->msg = $e->getMessage();
    $this->status = config('status.failed');
    if ($this->msg == config('status.goto')) {
      $this->status = config('status.goto');
    }
    return json([
      'status' => $this->status,
      'message' => $this->msg,
      'result' => NULL,
    ]);
  }
}
