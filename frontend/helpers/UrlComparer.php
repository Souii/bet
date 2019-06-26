<?php

namespace frontend\helpers;

class UrlComparer
{
  public static function compare($pattern, $url)
  {
    $url = substr($url, 0, strlen($pattern));

    if ($url == $pattern)
      return true;

    return false;
  }
}
