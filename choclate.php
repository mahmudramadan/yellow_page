<?php
 function return_count_eat($n , $c , $m)
  {
  // $n money
  // $n cost of choclate
  // $n wrapper count to exchange 

    $t = 0 ;// count of choclate eat
    $wrapper_eat = 0 ;
    if ($n >= $c ) {
     $t += $n/$c;
     $wrapper_eat += $t; 
   }

   while ($wrapper_eat >= $m ) {
    $t += (int)  ($wrapper_eat / $m) ;
    $wrapper_eat = (int) ($wrapper_eat / $m) +( $wrapper_eat % $m);
   }
  echo  $t;

}

$n = $_GET['n'];
$c = $_GET['c'];
$m = $_GET['m'];

return_count_eat($n,$c,$m);


?>