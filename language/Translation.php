<?php
class Translation{

   private $language;
   private $translated;

    function setLanguage($language = "en_US")
    {
      $this->language = $language;
    }

    function translate($word)
    {
      $myfile = file("language/".$this->language.".txt");

      $translated;

      foreach($myfile as $key=>$var)
      {
         if(strstr($var,$word)){
            //$this->translated .= "<br/>" . str_replace("'$word': ","", $var);
            $this->translated = ucfirst(preg_replace("/$word:\s/","", $var));
         } 
      }
      return $this->getTranslated();      
    }
    function getLanguage(){ return $this->language; }
    function getTranslated(){ return $this->translated; }

}
// Test translation
//$word = 'guestbook';

$translation = new Translation();

/*
$translation->translate($word);
$translation->translate("view guestbook");
$translation->translate("english");
$translation->translate("spanish");
$translation->translate("thanks for coming");

echo '<pre>';print_r($translation);
*/