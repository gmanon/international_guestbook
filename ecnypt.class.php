<?php
class Encrypt{
   private $data;
   private $coded_data;
   private $iv;
   private $ivlen;
   private $tag;
   private $key;

   function __CONSTRUCT()
   {
      $this->cipher = "aes-128-gcm";
      $this->ivlen = openssl_cipher_iv_length($this->cipher);
      $this->iv = openssl_random_pseudo_bytes($this->ivlen);
   }

   function encode($row_data)
   {
      if(in_array($this->cipher, openssl_get_cipher_methods()))
      {
         $this->coded_data = 
            openssl_encrypt(
               $row_data, 
               $this->getCipher(), 
               $this->key, 
               $options=0, 
               $this->getIv(), 
               $this->tag
              );
      }
      return $this->getCodedData();
   }

   function decode($encrypted_data)
   {
      if(in_array($this->cipher, openssl_get_cipher_methods()))
      {
         $this->data = 
            openssl_decrypt(
               $encrypted_data, 
               $this->getCipher(), 
               $this->key, 
               $options=0, 
               $this->getIv(), 
               $this->tag
              );
      }
      return $this->getData();
   }

   function getData(){ return $this->data; }
   function getCodedData(){ return $this->coded_data; }
   function getIv(){ return $this->iv; }
   function getIvlen(){ return $this->ivlen; }
   function getTag(){ return $this->tag; }
   function getKey(){ return $this->key; }
}

// Testing
$data_to_encrypt = "Los zapatitos me aprietan, 
las medias me dan calor, pero el bezo que me dio mi 
madmadre lo guardo en mi corazon";

$c = new Encrypt();
$encrypted = $c->encode($data_to_encrypt);
$c->encode($encrypted);

print_r($c);
