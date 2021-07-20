<?php

class iPay{
    
    private $baseUrl = 'https://apis.staging.ipayafrica.com/b2c/v3';
    
    private $defaultChannel = 'mpesa';
    
    private $vid;
    
    private $securityKey;
    
    public function __construct($securityKey, $vid){
        $this->vid = $vid;
        $this->securityKey = $securityKey;
        
    }
    
    function initiateTransaction($transaction){
        
        if($this->securityKey == null || $this->vid == null)
            throw new \Exception('Provid the Security Key and VID values.');
        
        if($transaction == null)
            throw new \Exception('You must provide a valid transaction.');
        
        if($transaction->amount == null 
            || $transaction->phone == null
            || $transaction->reference == null)
            throw new \Exception('Ensure all transaction details have been provided.');
            
            $datastring = "amount=".$transaction->amount
                ."&phone=".$transaction->phone
                ."&reference=".$transaction->reference                
                ."&vid=".$this->vid;
            
            $hashid = hash_hmac("sha256", $datastring, $this->securityKey);
            
            $datastring = "amount=".$transaction->amount
            ."&hash=".$hashid
            ."&phone=".$transaction->phone
            ."&reference=".$transaction->reference
            ."&vid=".$this->vid;
            
            $url = $this->baseUrl.'/mobile/'.$this->defaultChannel;
            
            try {
                try {
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL,$url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring);
                    $serverResponse = curl_exec($curl);
                    $error = curl_error($curl);
                    curl_close($curl);
                    if($error != null){
                        return json_decode($serverResponse);
                    }else
                        throw new \Exception($error);
                } catch (\Exception $e) {
                    var_dump($e);
                    throw new \Exception($e->getMessage());
                }
                
            } catch (\Exception $e) {
                var_dump($e);
                throw new \Exception($e->getMessage());
            }
    }
    
    function checkTransactionStatus($reference){
        
        if($reference == null)
            throw new \Exception('Provid the transaction reference value.');
            
            
        $url = $this->baseUrl.'/transaction/status';
        $datastring = "reference=".$reference
        ."&vid=".$this->vid;
        $hashid = hash_hmac("sha256", $datastring, $this->securityKey);
        
        $datastring = "hash=".$hashid
        ."&reference=".$reference
        ."&vid=".$this->vid;
        
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,$url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring);
            $serverResponse = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);
            if($error != null){
                return json_decode($serverResponse);
            }else
                throw new \Exception($error);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
    }
}

