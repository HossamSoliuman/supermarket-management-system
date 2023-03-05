<?php
include "model/sheft_frame.php";
$sheft=new sheft;
$info=$sheft->get_info($sheft->get_last_id());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>End sheft</title>
</head>
<body>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <?php 
        
        echo '
        <h5 class="card-title">Sheft time </h5>
        <p class="card-text">Sheft started at :'.$info->start_time_h.' </p>
        <p class="card-text">Will be end now : '. date("H")+1 .'</p>
        <p class="card-text">Net workind hours : '.date("H")-$info->start_time_h+1 .'</p>
        <a href="worker.php" class="btn btn-primary">Back to continue the sheft</a>
        <a href="#" class="btn btn-danger">End the sheft now</a>
        ';
        ?>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
    
        
        
        <h3 class="card-title">Sheft money informations </h3>
        <p class="card-text">Total sheft money :
          
         <?php  echo $info->total_money ;?></p>
       
        <a href="worker.php" class="btn btn-primary">Back to continue the sheft</a>
        <form action="" method="post">
        <button type="submit" name="end_sheft" class="btn btn-danger">End the sheft now</button>
        </form>
        
      </div>
    </div>
  </div>
</div>

    
</body>
</html>
<?php
if(isset($_POST['end_sheft']))
{
    $sheft->update_end_date();
    header("location:index.php");
}
