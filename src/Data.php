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

   private $url =  'api/v1/products/productdata';

   public function __construct($username,$apikey) {
      parent::__construct($username,$apikey);
   }


   public  function getProductInfo($searchValue,$country,$localeID = 1){
      if(!empty($searchValue) && !empty($country)){
         $params = array(
            'country' => $country,
            'name' => $searchValue,
         );
         $this->curlResult = $this->curlRequest($params,$this->url);
      }else{
         $this->curlResult['status'] = false;
         $this->curlResult['errorMsg'] = 'No curl request sent because no search value and/or country found';
      }
      return $this->curlResult;
   }
}