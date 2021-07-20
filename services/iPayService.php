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
        
        if($response->status == 200)
            echo 'Your transaction has been received. Ref ID: '.$response->reference;
        else 
            echo 'We encountered and error.';
        
    }
    
    function checkTransactionStatus($reference){
        
        $ipay = new iPay('demo', 'demo');
        
        $response = $ipay->checkTransactionStatus($reference);
        
        if($response->status == 200)
            echo 'Your was successfule. Receipt Number: '.$response->mmref;
        else
            echo 'We encountered and error.';
    }
}

