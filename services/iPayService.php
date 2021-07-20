<?php

require_once 'models/transaction.php';
require_once 'lib/iPay.php';

class iPayService{
    
    function initiateTransaction($amount, $reference, $phone){
        
        $transaction = new Transaction();
        $transaction->amount = $amount;
        $transaction->phone = $phone;
        $transaction->reference = $reference;
        
        $ipay = new iPay('demo', 'demo');
        
        $response = $ipay->initiateTransaction($transaction);
        
        if($response->error != null){
            return json_encode(array('message' => $response->error, 'status'=>false));
        }else{
            return json_encode(array('message' => 'Your transaction has been received. Ref ID: '.$response->reference, 'status'=>true));
        }
    }
    
    function checkTransactionStatus($reference){
        
        $ipay = new iPay('demo', 'demo');
        
        $response = $ipay->checkTransactionStatus($reference);
        
        if($response->error != null){
            return json_encode(array('message' => $response->error, 'status'=>false));
        }else{
            return json_encode(array('message' => 'Your was successfule. Receipt Number: '.$response->mmref, 'status'=>true));
        }
        
    }
}

