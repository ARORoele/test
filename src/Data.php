<?php
/**
 * Created by PhpStorm.
 * User: ARO
 * Date: 08/08/2018
 * Time: 09:43
 */

namespace Datapharma\Product;

class Data extends \Curl
{
   public function __construct($username,$apikey) {
      parent::__construct($username,$apikey);

   }


   public static function version(){
      return 'DataPharma package v_1.0.9';
   }
}