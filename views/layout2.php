<?php
require_once("CommonViews.php");
$r=new commonViews();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<script src="./jquery-3.6.0.js"></script>
    <script src="./jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/356c3beb3c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<?php
         $r->NavbarAdmin();
        ?>
    <div class="container">
    
    
    <?php
         echo $content;
       
        ?>
        
    </div>
    <?php
    $r->Footer();
    ?>
  
</body>

</html>