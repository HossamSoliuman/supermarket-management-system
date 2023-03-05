<?php

 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Reports</title>
</head>
<body>
    <p style="display:inline ;">Choose the date that you want reports be with in</p>
    <form  method="post">    <input type="date"  name="date" >
        <input type="submit" name="submit" >
    </form>
<?php 

if(isset($_POST['submit']))
{
  echo $_POST['date'];
    include "model/sales.php";
    $sales=new sales;
    $sales=$sales->show($_POST['date']);
    $total_sale_profets=0;
    $total_sale_money=0;
    foreach($sales as $item)
    {
        
        $total_sale_profets+=$item['total_profits'];
        $total_sale_money+=$item['TSM'];
        
    }
    $sales=new sales;
?>
<div class="row">
  
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
    
        
        
        <h3 class="card-title">Total sales money :<?php echo $total_sale_money;?> </h3>
        <h3 class="card-text">Total sales profet :<?php echo $total_sale_profets;?> </h3>
          
         
        
        
      </div>
    </div>
  </div>
  
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
    
        
        
        <h3 class="card-title">Lowest Profitable product :<?php echo $sales->lowest($_POST['date'])?>  </h3>
        <h3 class="card-text">Most Profitable product :<?php echo $sales->most($_POST['date'])?> </h3>
          
         
        
        
      </div>
    </div>
  </div>
</div>


    
    

<table class="table">
  <thead>
    <tr>
      <th scope="col">product name</th>
      <th scope="col">Remaining quantity</th>
      <th scope="col">Number of sales</th>
      <th scope="col">Profets</th>
    </tr>
  </thead>

  <tbody>
 <?php
  $sales=new sales;
 $sales=$sales->show($_POST['date']);
 foreach($sales as $item)
 {
    echo '
    <tr>
      <th scope="row">'.$item['product_name'].'</th>
      <td>'.$item['product_number'].'</td>
      <td>'.$item['number_of_sales'].'</td>
      <td>'.$item['total_profits'].'</td>
    </tr>
    ';
    
 }
 
 ?>
  </tbody>
</table>
<?php
}
?>
</body>
</html>