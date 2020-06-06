<?php

  class ConvertMarr {
    
    public function __construct() {
      
    }
    
    public function convertMArr($arr) {
      
      /**Working explanation for convertMArr().
       * 
       * convertMArr() is a recursive function that is repeated for the number of arrays in a multidimentional array. It goes as deep as the how deep the multidimentional array is and "stringifies" every array.
       * 
       * @input : You pass in a multidimentional array as argument to function.
       * 
       * steps :
       * 
       * 1. is_SorA() function checks if every element of 1st dimension array is either string/array. exits the function if false and returs the string "Invalid Array".
       * 
       * 2. if is_SorA() return true, array enters a infinite loop which will be exited when parent function (convertMArr) returns its result.
       * 
       * 3. is_every() function with type parameter set as string checks if weather all element in the array (1st dimension) is sring or not.
       * 
       * 4. if is_every() returns true, array is conveted into string using stringifyArr() function. and returns the string as result of parent function.
       * 
       * 5. if is_every() returns false, array is passed into a foreach loop where it runs is_array() function on each element of array.
       * 
       * 6.0.1 if is_array() retuns false a if (elseif) statement checks wether the current element is the first (0th) element of array or not, if the statement returns true loop continues by skipping next lines.
       * 
       * 6.0.2. if its not the first element of array a variable named str ($str) is appended with "( ", current element of array, and " )". 
       * 
       * 6.1.1 if is_array() returns true, a variable str ($str) is appended with result of convertMArr() function on current element of array (convertMArr("current element of array")), which is wrapped by "( " and " )".
       * 
       * 6.1.1.1 if elements of array(current element) is arrays convertMArr() is applied of those too. it will run untill nth dimension and convert arrays into strings.
       * 
       * 7. $str is appended with the 0th element of array. (specefic for this function usage, can be ommited if not necessary)
       * 
       * 8. rtrim() function is used to trim out the "0th element of array" from the end of $str, because "0th element of array" is appended one extra time to $str. (again, specefic for this function usage, can be ommited if not necessary)
       * 
       * 9. $str is returned as the result of convertMArr() function after every dimension of array is converted into string. and the infinite while loop is exited as the function is over.
       * 
       * @output : Function return a string that is "stringified" according to the algorithm in stringifyArr() function
      */
      
      /** Documentation for convertMarr().
       * 
       * convertMArr() is a function that is used to convert a multidimensional array into a string (even the deepest dimension is "stringified").
       * 
       * @param multidimensional array $arr : multidimensional array to be converted. (single dimension array is also accepted)
       * 
      */
      
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