<?php

namespace frontend\components;

class SimpleSessionStorage
{
  private $name;
  private $session;

  public function __construct($name)
  {
    $this->name = $name;
    $this->session = \Yii::$app->session;
  }

  public function getData()
  {
    if ($this->session->has($this->name))
      return [$this->name => $this->session[$this->name]];
  }

  public function getDataByName($name)
  {
    if ($this->session->has($this->name))
      return $this->session[$this->name][$name];
  }

  public function save($data)
  {
    if (!$this->session->has($this->name))
      $this->session[$this->name] = [];
    $this->session[$this->name] = array_merge($this->session[$this->name], $data);
  }

  public function clear()
  {
    if ($this->session->has($this->name))
      $this->session->remove($this->name);
  }


}
