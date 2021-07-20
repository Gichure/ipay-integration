<?php

require_once 'services/iPayService.php';
$message = "";
    
    $phone = "254720000000";
    
    $amount = 1;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone = sanitize($_POST["phone"]);
        $amount = sanitize($_POST["amount"]);
        $reference = rand(1,999999);
        $service = new iPayService();
        $response = $service->initiateTransaction($amount, $reference, $phone);
        $response = json_decode($response);
        $message = $response->message;
        
    }
    
    function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    


?>


<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="iPay B2C Integration" name="description">
      	<meta content="iPay B2C Integration, iPay, Payment Gateways" name="keywords">
        <meta name="author" content="Paul Gichure">
    
        <title>iPay B2C API Integration</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">iPay B2C API Integration</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Send Money</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./check-status.php">Check Status</a>
        </li>
    </ul>
</div>
</nav>
<!-- /navbar -->

<div class="container mt-5">
<div class="row" align="center">
    <div class="col-sm">
        <h1>Send Money</h1>
        <p><?php echo $message; ?>
    </div>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="row">
        <div class="col-sm">
              
            <table class='table table-hover'>
      
                <tr>
                    <td>Phone Number</td>
                    <td><input type='text' name='phone' class='form-control' required></td>
                </tr>
      
                <tr>
                    <td>Amount(KES)</td>
                    <td><input type='number' name='amount' class='form-control' required></td>
                </tr>
      
      
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Send</button></td>
                </tr>
      
            </table>
                  
        </div>
    </div>
</div>
</form>
</body>
</html> 