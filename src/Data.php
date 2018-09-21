<?php
/**
 * Created by PhpStorm.
 * User: ARO
 * Date: 08/08/2018
 * Time: 09:43
 */

namespace Datapharma\Product;

use Datapharma\Product\Curl\Curl;

class Data extends Curl
{
   private $url =  'api/v1/products/';

   public function __construct($username,$apikey) {
      parent::__construct($username,$apikey);
   }

   /**
    * @param searchValue
    * Should be a string to respresent a name, will be a like "%%" request
    * @param country
    * This is the upper case abbrev for a country
    * For example : France => FR
    * @param localeID
    * This is a numeric value that represents the language
    * The value 1 is always the main language of the country
    * For example : France => 1
    * @return array
    * Status => True/false
    * ErrorMsg => displays what went wrong if the status is False
    * Data => All data related to the search if the status is True
    */

   public  function getProductInfo($searchValue,$country,$localeID = 1){
      if(!empty($searchValue) && !empty($country)){
         $params = array(
            'country' => $country,
            'name' => $searchValue,
         );
         $this->curlResult = $this->curlRequest($params,$this->url . 'productdata');
      }else{
         $this->curlResult['status'] = false;
         $this->curlResult['errorMsg'] = 'No curl request sent because no search value and/or country found';
      }
      return $this->curlResult;
   }

   /**
    * @param country
    * This is the upper case abbrev for a country
    * For example : France => FR
    * @return array
    * Status => True/false
    * ErrorMsg => displays what went wrong if the status is False
    * Data => All data related to the search if the status is True
    */

   public  function getAllProductsWithMainBarcodes($country){
      if(!empty($country)){
         $params = array(
            'country' => $country,
         );
         $this->curlResult = $this->curlRequest($params,$this->url. 'getallmainbarcodes');
      }else{
         $this->curlResult['status'] = false;
         $this->curlResult['errorMsg'] = 'No curl request sent because no search country found';
      }
      return $this->curlResult;
   }


}