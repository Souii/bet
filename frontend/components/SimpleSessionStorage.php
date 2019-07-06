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

  public function getAll()
  {
      if (!$this->isEmpty()) {
          return [$this->name => $this->session[$this->name]];
      }
  }

  public function get($name)
  {
      if (!$this->isEmpty()) {
          return $this->session[$this->name][$name];
      }
  }

  public function save($data)
  {
      if ($this->isEmpty()){
          $this->session[$this->name] = [];
      }
      $this->session[$this->name] = array_merge($this->session[$this->name], $data);
  }

  public function clear()
  {
      if (!$this->isEmpty()) {
          $this->session->remove($this->name);
      }
  }

  public function isEmpty()
  {
      return !$this->session->has($this->name);
  }


}
