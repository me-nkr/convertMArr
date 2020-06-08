<?php

  class ConvertMarr {
    
    public function __construct() {
      
    }
    
    public function convertMArr($arr) {
      
      
      
      if (! $this->is_SorA($arr)) return "Invalid Array" ;
      
      while(true) {
        
        if ($this->is_every("string", $arr)) return $this->stringifyArr($arr) ;
        
        foreach ($arr as $e) {
          
          if (is_array($e)) $str .= "( ".$this->convertMArr($e)." )" ;
          
          elseif ($e === $arr[0]) continue ;
          
          else $str .= "( $e )" ;
          
          $str .= " $arr[0] " ;
        }
        
        $str = rtrim($str, " $arr[0] ") ;
        return $str ;
      }
    }
  
    private function is_every($type,$arr) {
      return array_sum(
        array_map("is_$type", $arr)) === count($arr);
    }
    
    private function is_SorA($arr) {
      foreach ($arr as $e) {
        if (! (is_string($e) || is_array($e))) {
          return false ;
        }
      }
      return true ;
    }
    
    private function stringifyArr($arr){
      
      $c = count($arr) ;
      $op = $arr[0] ;
      
      switch ($op) {
        case 'AND':
        case 'OR':
          
          for ($i = 1; $i < $c; $i++) {
         
             $str .= "( $arr[$i] )" ;
             if ($i === $c-1) break ;
             $str .= " $op " ;
             
          }
          break;
          
        case 'NOT':
          
          if ($c > 2){
            return "invalid condition" ;
          }
          else{
            $str = "$op ( $arr[1] )" ;
          }
          break;
        
        default:
          $str = $arr[0] ;
          break;
      }
      
      return $str ;
    }
    
  }