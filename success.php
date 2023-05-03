<?php

$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("mlee5f74aac36ddbf");
$store_passwd=urlencode("mlee5f74aac36ddbf@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

    $result = json_decode($result);
    $status = $result->status;
    $tran_date = $result->tran_date;
    $tran_id = $result->tran_id;
    $val_id = $result->val_id;
    $amount = $result->amount;
    $store_amount = $result->store_amount;
    $bank_tran_id = $result->bank_tran_id;
    $card_type = $result->card_type;
    $emi_instalment = $result->emi_instalment;
    $emi_amount = $result->emi_amount;
    $emi_description = $result->emi_description;
    $emi_issuer = $result->emi_issuer;

    $card_no = $result->card_no;
    $card_issuer = $result->card_issuer;
    $card_brand = $result->card_brand;
    $card_issuer_country = $result->card_issuer_country;
    $card_issuer_country_code = $result->card_issuer_country_code;
    $APIConnect = $result->APIConnect;
    $validated_on = $result->validated_on;
    $gw_version = $result->gw_version;
    $pres_id = $result->value_a;
    $connection =  new mysqli('localhost','root','','hms');

    $sql ="UPDATE prescription SET updated_at='$tran_date', txd_id = '$tran_id', payment_status='PAID' WHERE id='$pres_id'";

    $connection->query($sql);

    header("location:profile.php");
} else {

    echo "Failed to connect with SSLCOMMERZ";
}

