<?php

require_once '../services/iPayService.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reference = sanitize($_POST["reference"]);
        $service = new iPayService();
        $service->checkTransactionStatus($reference);
    }
    
    function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    


?>


<html>

<header>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</header>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">iPay B2C API Integration</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="../">Send Money</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Check Status</a>
        </li>
    </ul>
</div>
</nav>

<div class="container mt-5">
<div class="row" align="center">
    <div class="col-sm">
        <h1>iPay B2C API Integration</h1>
    </div>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="row">
        <div class="col-sm">
              
            <table class='table table-hover'>
      
                <tr>
                    <td>Reference Number</td>
                    <td><input type='text' name='reference' class='form-control' required></td>
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