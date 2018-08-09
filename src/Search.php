<?php
/**
 * Created by PhpStorm.
 * User: ARO
 * Date: 07/08/2018
 * Time: 09:58
 */

namespace Datapharma\Product;

use Datapharma\Product\Curl\Curl;

class Search extends Curl
{
   private $url =  'api/v1/products/search';

   public function __construct($username,$apikey) {
      parent::__construct($username,$apikey);
   }

   /**
    * @param searchValue
    * Can be the main barcode for the country or the name
    * @param country
    * This is the upper case abbrev for a country
    * For example : France => FR
    * @return array
    * Status => True/false
    * ErrorMsg => displays what went wrong if the status is False
    * Data => All data related to the search if the status is True
    */

   public  function searchProducts($searchValue,$country,$image = false){
      if(!empty($searchValue) && !empty($country)){
         $params = array(
            'country' => $country,
            'search' => $searchValue,
            'image' => $image,
         );
         $this->curlResult = $this->curlRequest($params,$this->url);
      }else{
         $this->curlResult['status'] = false;
         $this->curlResult['errorMsg'] = 'No curl request sent because no search value and/or country found';
      }
      return $this->curlResult;
   }

   /**
    * @param id
    * Should be the ID from a product
    * @param country
    * This is the upper case abbrev for a country
    * For example : France => FR
    * @return array
    * Status => True/false
    * ErrorMsg => displays what went wrong if the status is False
    * Data => All data related to the search if the status is True
    */

   public  function searchProductByID($id,$country,$localeID = 1){
      if(!empty($id) && !empty($country)){
         $params = array(
            'country' => $country,
            'id' => $id,
         );
         $this->curlResult = $this->curlRequest($params,$this->url);
      }else{
         $this->curlResult['status'] = false;
         $this->curlResult['errorMsg'] = 'No curl request sent because no search value and/or country found';
      }
      return $this->curlResult;
   }
}