<?php

namespace Drupal\paypaytm;

use paytmpg\pg\enums\EChannelId;
use paytmpg\pg\models\Money;
use paytmpg\merchant\models\PaymentDetail\PaymentDetailBuilder;
use paytmpg\pg\process\Payment;
use paytmpg\pg\models\UserInfo;
use Drupal\commerce_payment\Plugin\Commerce\PaymentGateway\OffsitePaymentGatewayInterface;

class PaytmLibrary {
  public function initialization(OffsitePaymentGatewayInterface $payment_gateway_plugin) {
    try {
      $merchant_id = $payment_gateway_plugin->getConfiguration()['merchant_id'];
      $merchant_key = $payment_gateway_plugin->getConfiguration()['merchant_key'];
      $merchant_website = $payment_gateway_plugin->getConfiguration()['merchant_website'];
      $mode = $payment_gateway_plugin->getConfiguration()['pmode'];
      if ($mode == 'test') {
        $environment = LibraryConstants::STAGING_ENVIRONMENT;
      }
      else {
        $environment = LibraryConstants::PRODUCTION_ENVIRONMENT;
      }
      $client_id = "WEB";

      // $callbackUrl = "MERCHANT_CALLBACK_URL";
      // MerchantProperties::setCallbackUrl($callbackUrl);

      MerchantProperties::initialize($environment, $merchant_id, $merchant_key, $client_id, $merchant_website);
      // If you want to add log file to your project, use below code.
      Config::$monologName = '[PAYTM]';
      Config::$monologLevel = MonologLogger::INFO;
    }
    catch (Exception $e) {
      $error = "PAYTM: Exception caught in setInitialParameters" . PHP_EOL;
      $error .= $e->getMessage();
      \Drupal::logger('paypaytm')->error($error);
      drupal_set_message($error, 'error');
    }
  }
  public function createTransactionToken($paramList) {
    try {
      $channelId = EChannelId::WEB;
      $orderId = $paramList['ORDER_ID'];
      $txnAmount = Money::constructWithCurrencyAndValue(EnumCurrency::INR, $paramList['TXN_AMOUNT']);
      $userInfo = new UserInfo($paramList['CUST_ID']); 
      $userInfo->setAddress($paramList['USR_ADDRESS']);
      $userInfo->setEmail($paramList['USR_EMAIL']);
      $userInfo->setFirstName($paramList['USR_NAME']);
      $userInfo->setLastName($paramList['USR_NAME_lAST']);
      $userInfo->setMobile('');
      $userInfo->setPincode('');
      $paymentDetailBuilder = new PaymentDetailBuilder($channelId, $orderId, $txnAmount, $userInfo);
      $paymentDetail = $paymentDetailBuilder->build();
      $response = Payment::createTxnToken($paymentDetail);
      return $response->getResponseObject();
    }
    catch (Exception $e) {
      $error = "PAYTM: Exception caught in createTxnTokenwithRequiredParams" . PHP_EOL;
      $error .= $e->getMessage();
      \Drupal::logger('paypaytm')->error($error);
      drupal_set_message(t($error), 'error');
    }
  }

  function encrypt_e($input, $ky) {
    $key = $ky;
    $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
    $input = $this->pkcs5_pad_e($input, $size);
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
    $iv = "@@@@&&&&####$$$$";
    mcrypt_generic_init($td, $key, $iv);
    $data = mcrypt_generic($td, $input);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $data = base64_encode($data);
    return $data;
  }
  function decrypt_e($crypt, $ky) {
    $crypt = base64_decode($crypt);
    $key = $ky;
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
    $iv = "@@@@&&&&####$$$$";
    mcrypt_generic_init($td, $key, $iv);
    $decrypted_data = mdecrypt_generic($td, $crypt);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $decrypted_data = $this->pkcs5_unpad_e($decrypted_data);
    $decrypted_data = rtrim($decrypted_data);
    return $decrypted_data;
  }
  function pkcs5_pad_e($text, $blocksize) {
    $pad = $blocksize - (strlen($text) % $blocksize);
    return $text . str_repeat(chr($pad), $pad);
  }
  function pkcs5_unpad_e($text) {
    $pad = ord($text{strlen($text) - 1});
    if ($pad > strlen($text))
      return false;
    return substr($text, 0, -1 * $pad);
  }
  function generateSalt_e($length) {
    $random = "";
    srand((double) microtime() * 1000000);
    $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
    $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
    $data .= "0FGH45OP89";
    for ($i = 0; $i < $length; $i++) {
      $random .= substr($data, (rand() % (strlen($data))), 1);
    }
    return $random;
  }
  function checkString_e($value) {
    $myvalue = ltrim($value);
    $myvalue = rtrim($myvalue);
    if ($myvalue == 'null') {
      $myvalue = '';
    }
    return $myvalue;
  }
  function getChecksumFromArray($arrayList, $key, $sort = 1) {
    if ($sort != 0) {
      ksort($arrayList);
    }
    $str = $this->getArray2Str($arrayList);
    $salt = $this->generateSalt_e(4);
    $finalString = $str . "|" . $salt;
    $hash = hash("sha256", $finalString);
    $hashString = $hash . $salt;
    $checksum = $this->encrypt_e($hashString, $key);
    return $checksum;
  }
  function getChecksumFromString($str, $key) {

    $salt = $this->generateSalt_e(4);
    $finalString = $str . "|" . $salt;
    $hash = hash("sha256", $finalString);
    $hashString = $hash . $salt;
    $checksum = $this->encrypt_e($hashString, $key);
    return $checksum;
  }
  function verifychecksum_e($arrayList, $key, $checksumvalue) {
    $arrayList = $this->removeCheckSumParam($arrayList);
    ksort($arrayList);
    $str = $this->getArray2Str($arrayList);
    $paytm_hash = $this->decrypt_e($checksumvalue, $key);
    $salt = substr($paytm_hash, -4);
    $finalString = $str . "|" . $salt;
    $website_hash = hash("sha256", $finalString);
    $website_hash .= $salt;
    $validFlag = "FALSE";
    if ($website_hash == $paytm_hash) {
      $validFlag = "TRUE";
    } else {
      $validFlag = "FALSE";
    }
    return $validFlag;
  }
  function verifychecksum_eFromStr($str, $key, $checksumvalue) {
    $paytm_hash = $this->decrypt_e($checksumvalue, $key);
    $salt = substr($paytm_hash, -4);
    $finalString = $str . "|" . $salt;
    $website_hash = hash("sha256", $finalString);
    $website_hash .= $salt;
    $validFlag = "FALSE";
    if ($website_hash == $paytm_hash) {
      $validFlag = "TRUE";
    } else {
      $validFlag = "FALSE";
    }
    return $validFlag;
  }
  function getArray2Str($arrayList) {
    $paramStr = "";
    $flag = 1;
    foreach ($arrayList as $key => $value) {
      if ($flag) {
        $paramStr .= $this->checkString_e($value);
        $flag = 0;
      } else {
        $paramStr .= "|" . $this->checkString_e($value);
      }
    }
    return $paramStr;
  }
  function redirect2PG($paramList, $key) {
    $hashString = $this->getchecksumFromArray($paramList);
  }
  function removeCheckSumParam($arrayList) {
    if (isset($arrayList["CHECKSUMHASH"])) {
      unset($arrayList["CHECKSUMHASH"]);
    }
    return $arrayList;
  }
  function getTxnStatus($requestParamList) {
    return $this->callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
  }
  function initiateTxnRefund($requestParamList) {
    $checksum = $this->getChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
    $requestParamList["CHECKSUM"] = $checksum;
    return $this->callAPI(PAYTM_REFUND_URL, $requestParamList);
  }
  function callAPI($apiURL, $requestParamList) {
    $jsonResponse = "";
    $responseParamList = [];
    $JsonData = json_encode($requestParamList);
    $postData = 'JsonData='.urlencode($JsonData);
    $ch = curl_init($apiURL);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData))
    );
    $jsonResponse = curl_exec($ch);
    $responseParamList = json_decode($jsonResponse,true);
    return $responseParamList;
  }
}