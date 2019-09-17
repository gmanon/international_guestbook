<?php
/** 
 * @author:       Guillermina Gonjon
 * @date:         August 18, 2019
 * @name:         Guestbook
*/
/**
 * @name return string
 * @address return string
 * @email   return string ( If available convert to binary )
 * @phone   return string ( If available convert to binary )
 * @inviter return string
*/
session_start();
ob_flush();

require_once "error.php";
require_once "encrypt.class.php";
require_once "language/Translation.php";

$language = "en_US";
if((!isset($_SESSION['language']))&& (!isset($_GET['language'])))
{ $_SESSION['language'] = $language; /* setting default value*/
}elseif((isset($_GET['language']))||(!$_SESSION['language']==$language))
{ $_SESSION['language'] = $_GET['language'];
}else{
   $_SESSION['language'] = $_SESSION['language']; /*$_SESSION['language'] = $_SESSION['language']*/; 
}
//$translation->setLanguage("es_DR");
$translation->setLanguage($_SESSION['language']);
//$translation->setLanguage("af_african");
$c = new Encrypt();
//echo $c->encode("This is a test. Let's see what happens.");
show_error();
if($_GET['page']=='show_list')
{
   require_once "show_list.phtml";
}elseif($_GET['page']=='pick_language'){
   require_once "language_select.phtml";
}else{
   require_once "index.phtml";
}

function Write($file, $data, $type="sql")
{  
   $result = "("; // holder
   $keys = "INSERT INTO `guestbook`(";
   foreach($data as $key=>$value)
   {  
         if(($key != 'page')&&($key != 'action'))
         {$keys .= "'".htmlentities($key)."', ";
         $result .= "'".htmlentities($value)."', ";}
   }
   $keys .= ")";
   $keys = str_replace(", 'submit', )",")",$keys);
   $keys .= " VALUES ";
   $result .= ");\n";
   $result = str_replace(", 'send', );",");",$result);
   if($type == "sql"){ $resu = $keys . $result; }
   elseif($type == "scv"){
      $resu = $result;
   }
      return $resu;
      file_put_contents($file,$resu, FILE_APPEND);   
}
   $myfile = file_get_contents("secret-w/list.scr");

   $thefile = file("secret-w/list.scr");
   file_put_contents("secret-r/list.sql",$myfile, FILE_BINARY);
   print $myfile;
function NoRepeat($file,$result,$type="sql")
{
   $new_entry = Write($file,$result,$type);
   $array_file = file($file);

   if(in_array($new_entry, $array_file))
   { 
      $_ERROR['NEW ENTRY'] = "ERRROR: Duplication\n";
   }
   else{
      file_put_contents($file,$new_entry, FILE_APPEND);
   }
}
   NoRepeat("secret-w/list.sql",$_GET);
   NoRepeat("secret-w/list.scv",$_GET,"scv");
   Write("secret-w/list.sql",$_GET);
   Write("secret-w/list.scv",$_GET,"scv");
   $entry = "";
   foreach($_GET as $t=>$v){$entry .= "&body=".ucwords($t).": ".$c->encode(ucwords($v))."\n";
      $entry = str_replace("+ "," ",$entry);
      $entry = str_replace("@","%40",$entry);
      $entry = str_replace(",","%2C",$entry);
      $entry = $c->encode($entry);
      
 }
echo "<p><a class='footer' 
href='mailto:gmanon@comcast.net?from=ggonjon@gmail.com&subject=Guestbook&body=$entry'>".
$translation->translate('send')."</a></p>";

