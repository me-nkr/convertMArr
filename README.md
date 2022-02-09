# convertMArr
 **convertMArr()** is a method used to convert a multidimentional array into string. The string will be in the specified format.
 
 > You can use this to convert spreadsheet syntax to SQL syntax
 
## useage 
* instantiate convertMArr class
  `new convertMArr()`
* call convertMArr() method with multidimentional array as arguement.
  `$obj->convertMArr(array)`

## example
`$data =  ["AND",["OR",["AND","A=B","C=D"],["AND","E=F","G=H"]],"Y!=X",["OR",["AND",["NOT","I=J"],["NOT","K=L"]],["M=N"]]] ;`

`$obj = new convertMArr() ;` 

`echo $obj->convertMArr($data) ;`

which will show `( ( ( A=B ) AND ( C=D ) ) OR ( ( E=F ) AND ( G=H ) ) ) AND ( Y!=X ) AND ( ( ( NOT ( I=J ) ) AND ( NOT ( K=L ) ) ) OR ( M=N ) )` as result.
