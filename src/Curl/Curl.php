<?php
/**
 * Created by PhpStorm.
 * User: ARO
 * Date: 08/08/2018
 * Time: 09:46
 */

namespace Datapharma\Product\Curl;

class Curl
{
   private $userName;

   private $apiKey;

   private $baseUrl = 'https://www.datapharma.virtualotc.eu/';

   private $curlObject;

   public $curlResult;

   public function __construct($userName,$apiKey) {
      $this->userName = $userName;
      $this->apiKey = $apiKey;
      $this->curlObject = curl_init();
   }

   protected function curlRequest($queryParams,$urlPath){
      if(!empty($this->curlObject) && !empty($queryParams)){
         $queryParams = array_merge($queryParams,array('username'=>$this->userName,'apikey'=>$this->apiKey));
         if(isset($queryParams['username']) && isset($queryParams['apikey'])){
            $queryParams = http_build_query($queryParams);
            curl_setopt_array($this->curlObject, array(
               CURLOPT_RETURNTRANSFER => 1,
               CURLOPT_IPRESOLVE => 1,
               CURL_IPRESOLVE_V4 => 1,
               CURLOPT_URL => $this->baseUrl .  $urlPath . '?' . $queryParams
            ));
            $this->curlResult['status'] = true;
            $this->curlResult['data'] = curl_exec($this->curlObject);
         }else{
            $this->curlResult['status'] = false;
            $this->curlResult['errorMsg'] = 'No curl request sent because no username and apikey found';
         }

      }else{
         $this->curlResult['status'] = false;
         $this->curlResult['errorMsg'] = 'No curl request sent because no username and/or apikey found';
      }
      return $this->curlResult;
   }
}