<?php
session_start();
if(isset($_SESSION['worker_name']))
{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sheft</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php include 'clock.php';echo $clock;?>
        <form method="post">
            <button name="start" type="submit" class="btn btn-outline-primary" style="width: 60%;">Start sheft</button>
            <button name="end" type="submit" class="btn btn-outline-danger">End sheft</button>
        </form>

    
    


    

    </div>
    <div class="subcon">
        <div class="form">
            <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                <div class="input-group">
                    <input name="name" type="text" class=" form-control" id="inlineFormInputGroupUsername"
                        placeholder="Name" required>
                    <input name="number" type="number" class=" form-control" id="inlineFormInputGroupUsername"
                        placeholder="Number" required>

                </div>
                <div class="col-12">
                    <button name="enter" type="submit" class="subm btn btn-primary">Enter</button>
                </div>
                <div class="col-12">
                    <button type="unset" class="subm btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
        

        <div class="invoice">
            <p>  </p>
            <?php
           
            include "model/products.php";
            include "model/invoice.php";
            include "model/sales.php";
            include "model/sheft_frame.php";
            $sheft=new sheft;
            $invo=new incoice;
            $product=new products;
            $sale=new sales;
                if(isset($_POST['enter']))
                {       
                    $pro=$product->check($_POST['name']);
                    if($pro)
                    {
                        $item_total_price=$pro->price* $_POST['number'];
                        $invo->add($pro->name,$pro->price,$_POST['number'],$item_total_price);
                        $items=$invo->show();
                        
                        
                    
                    echo '
                    <table class="table">
                        <thead>
                       <h3 style="text-alignt:center;"> The Invoice: </h3>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Number</th>
                            <th scope="col"> Price</th>
                            <th scope="col">Total</th>
                            
                            </tr>
                        </thead>
                        ';
                        foreach($items as $item)
                        {
                            echo '
                            <tbody>
                                <tr>
                                <th scope="row">'.$item['name'].' </th>
                                <td> '.$item['number'].' </td>
                                <td>'.$item['price'] .'</td>
                                <td>'.$item['total'].'</td>
                               
                                </tr>
   
                            
                     
                            ';
                        }
                    
                echo '
                <tr>
                <td>
                    <form  method="post">
                     <button class="subm btn btn-primary " type="submit" name="save_invoice" value="'.$item['id'].'">Save and print</button>
                    </form>
                </td>
                <td></td>
                <td>total=</td>
                <td>'.  $invo->total_price() .'</td>
                </tr>
                </tbody>
                     </table> 
                ';
                       
                                
                }
            }
            ?>
        </div>
    
    </div>

</body>

</html>
<?php
$_SESSION['current_sheft_id']=$sheft->get_last_id();
if(isset($_POST['start']))
{
    $start_time=date("Y-m-d");
    $start_time_h=date("H")+1;
    $sheft->add($start_time,0, $_SESSION['worker_name'],$start_time_h,0);
    
}
if(isset($_POST['save_invoice']))
{
    $date_h=date("H");
    $items=$invo->show();
    foreach($items as $it)
    {
        
        $sale->add($it['number'],date("Y-m-d"),$product->get_id($it['name']),$_SESSION['worker_name'],$date_h);
        $product->decrease($it['name'],$it['number']);
        
        
    }
    $sheft->update_total_money($invo->total_price());
    $invo->delete();
}
if(isset($_POST['end']))
{
    header("location:end_sheft.php");
}
// end bracket for if condetion in the top of the file
}else
header("location:index.php");
