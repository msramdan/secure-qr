<?php

class Message
{
  public static function success($message)
  {
    session()->flash('success', $message);
  }

  public static function danger($message)
  {
    session()->flash('danger', $message);
  }

  public static function warning($message)
  {
    session()->flash('warning', $message);
  }

  public static function info($message)
  {
    session()->flash('info', $message);
  }
}
