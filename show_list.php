<?php
/** @author: Guillermina Gonjon
 */
      $items = file("secret-w/list.scv");
      $items_per_page = 8;
      $total_items = count($items);
      $num_pages = ceil(($total_items / $items_per_page)/2);
      $left_items;
      $right_items;

      $counter = 1;
      $counter2 = 1;

if($_GET['action'] < 0){ $_GET['action'] = 0;}else{ $_GET['action'] = $_GET['action']; }
if($_GET['action'] > $num_pages)
{ $_GET['action'] = $num_pages + 1;}else
{ $_GET['action'] = $_GET['action']; }

if((!isset($_GET['action']))
||( $_GET['action'] <= $num_pages+1)
||(! $_GET['action'] <= 0))  {$page = 0; }
elseif($page >= $total_items){$page = $num_pages; } 
elseif($_GET['action'] < 0){$page = 0; } 
else{ $page = $_GET['action']; }

// Var List
      $current_page = $_GET['action'];
      $current_left_min = ($current_page * $items_per_page) +1;


foreach($items as $key=>$item)
{
   if($key >= $starting_item)
      {
         $item = str_replace("'","",$item);
         $item = str_replace("(","",$item);
         $item = str_replace(");","",$item);
         
         if(($current_left_min <= $key )
         &&(($current_left_min + $items_per_page/2) > $key))
         {  $left_items .= "<p><b>$key:</b>&nbsp;&nbsp$item</p>"; }

         if(($current_left_min +($items_per_page/2)-1 < $key )
         &&(($current_left_min + $items_per_page) > $key))
         {  $right_items .= "<p><b>$key:</b>&nbsp;&nbsp$item</p>"; }
      }
}
?>
