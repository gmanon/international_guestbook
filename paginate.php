<?php // viewer
echo "<style> td { padding:12px; border:1px solid}</style>";
      $items = file("secret-w/list.scv");
      $total_items = count($items);
      $items_per_page = 4;
      $num_pages = ceil($total_items / $items_per_page) + 1;
      $counter = 1;
      $counter2 = 1;

if((isset($_GET['page']))
&&( $_GET['page'] < $num_pages+1)
&&(! $_GET['page'] < 1))  {$page = $_GET['page']; }
elseif($page > $total_items){$page = $total_items; } 
elseif($_GET['page'] < 1){$page = 1; } 
else{ $page = 1; }


echo "<a href='paginate.php?page=1'> First </a>".
      " | <a href='paginate.php?page=".($page -1)."'> Preview </a>".
      " | <a href='paginate.php?page=".$page."'> ".$page." </a>".
      " | <a href='paginate.php?page=".($page+1)."'> Next </a>".
      " | <a href='paginate.php?page=".$num_pages."'> Last </a> | <br/>\n";
echo "\n<table>\n\t<tr>\n\t\t<td>";
      foreach($items as $key=>$var)
      {  
         if($var != null)
         {
            if($key % 8 == 0)
            {

                  
                  echo "\n\t\t</td>\n\t</tr>\n\t<tr>\n\t\t<td>\n";
                  echo "<h3>double pages $counter2:</h3>";
                  $counter2++; 
            }

            if($key % 4 == 0)
            { 
               echo "single page $counter: \n\t\t</td>\n\t\t<td>";
               $counter++; 
            }

            echo "$key: $var<br>";

         
         }


         
      }
echo "</td></tr></table>";

/*
      $myfile = file("secret-w/list.scv"); 
      echo "<h5>Index, Date, Name, Email, Inviter, Phone No., 
Building No., Street, City, State</h5>";
      foreach($myfile as $e=>$entry)
      {
         $entry = str_replace("(","",$entry);
         if(($e >= 4)&&($e < 8)){ echo "<p><font color='blue'>".($e+1).":</font> ".str_replace(");","<br>",$entry)."</p>";}
      }

*/
?>