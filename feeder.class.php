<?php
date_default_timezone_set('Europe/Bratislava');

class FeederElement
{
  private $element;

  private $date_format = "d F h:i A";
  
  private $time_nodes = array('registration', 'start_time', 'finished');
  
  function __construct($element, $params = array())
  {
    $this->element = $element;
    
    if (!empty($params)) {
      if (isset($params['date_format'])) {
        $this->date_format = $params['date_format'];
      }
    }
    
  }
  
  public function __get($value)
  {
    if (in_array($value, $this->time_nodes)) {
      $temp = new DateTime($this->element->$value);
      return $temp->format($this->date_format);
    }
    
    return $this->element->$value;
  }
}


class Feeder implements Iterator
{
  
  private $url        = NULL;
  private $xml        = NULL;
  
  private $loaded     = false;
  private $position   = 0;
  
  private $fields     = array();
  private $attributes = array();
  private $elements   = array();
  
  private $element_params = array();
  
  
  function __construct($url, $params = array())
  {
    if (!empty($params)) {
      $this->element_params = $params;
    }
    
    $this->load($url);
  }
  
  public function current()
  {
    return $this->elements[$this->position];
  }
  
  public function key()
  {
    return $this->position;
  }
  
  public function next()
  {
    ++$this->position;
  }
  
  public function rewind()
  {
    $this->position = 0;
  }
  
  public function valid()
  {
    return isset($this->elements[$this->position]);
  }
  
  public function fields()
  {
    return $this->fields;
  }
  
  private function load($url = NULL)
  {
    if ($url) {
      $this->url = $url;
    }
    
    if (($this->xml = simplexml_load_file($this->url)) === false) {
      return $this->loaded = false;
    }
    
    $this->loaded = true;
    return $this->parse();
  }
  
  private function parse()
  {
    if (!$this->loaded) {
      return false;
    }
    
    foreach($this->xml->attributes() as $key => $attr) {
      $this->attributes[$key] = $attr;
    }
    
    if(count($this->xml->children()) == 0) {
      return true;
    }
    
    foreach ($this->xml->children()->children() as $field) {
         $this->fields[] = $field->getName();
    }
    
    foreach ($this->xml->children() as $child) {
      $this->elements[] = new FeederElement($child, $this->element_params);
    }
    
    return true;
  }
}

?>