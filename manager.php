<?php 
    session_start();
    include "model/products.php";
    include "model/users.php";
    $user=new user;
    
    $product=new products;
    if(isset($_SESSION['worker_name'])&&$user->ismanager($_SESSION['worker_name']))
    {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <div class="container">

        <div class="add">
            <h2 style="text-align: center;"> Add product</h2>
            <form method="post" class=" form-add row row-cols-lg-auto g-3 align-items-center">
                <div class="input-group">

                    <input name="product_name" type="text" class="form-control" id="inlineFormInputGroupUsername"
                        placeholder="Product-name" required>

                </div>

                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                    <div class="input-group">

                        <input name="price" type="number" class="form-control" id="inlineFormInputGroupUsername"
                            placeholder="price" required>
                        <input name="number" type="number" class="form-control" id="inlineFormInputGroupUsername"
                            placeholder="number" required>
                        <input name="catagory" type="text" class="form-control" id="inlineFormInputGroupUsername"
                            placeholder="catagory" required>
                            <input name="buy_price" type="text" class="form-control" id="inlineFormInputGroupUsername"
                            placeholder="Buy price" required>
                    </div>

                </div>
                <div class="col-12">
                    <button name="add" type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>

        </div>

    </div>
    <div class="edit">
        <div class="search add">
            <h2 style="text-align: center;"> Edit product</h2>
            <form method="post" class=" form-add row row-cols-lg-auto g-3 align-items-center">
                <div class="input-group">
                    <input name="product_name" type="text" class="form-control" id="inlineFormInputGroupUsername"
                        placeholder="Product-name" required>

                </div>
                <div class="col-12">
                    <button name="show" type="submit" class="btn btn-primary">Show</button>
                </div>
            </form>
        </div>
        <?php
  
  
    if(isset($_POST['show']))
    {
        if($product->check($_POST['product_name']))
        {
            $_SESSION['product_name']=$_POST['product_name'];
            $info=$product->check($_POST['product_name']);
             
           
            echo '           
        <div class="subedit">
        <div class="add">
            <h2 style="text-align: center;"> Edit product</h2>
            <form method="post" class=" form-add row row-cols-lg-auto g-3 align-items-center">
                <div class="input-group">

                   ' .$info->name. ' 

                </div>

                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                    <div class="input-group">

                       price= <input name="price" type="number" class="form-control" id="inlineFormInputGroupUsername"
                            value="' .$info->price. '" required>
                            Packts=  <input name="number"  class="form-control" id="inlineFormInputGroupUsername"
                        value="  ' .$info->number. '" required> 
                       
                    </div>
                    <div class="input-group">
                        catagory= <input name="catagory" type="text" class="form-control" id="inlineFormInputGroupUsername"
                        value="  ' .$info->catagory. '" >
                        buy price= <input name="buy_price" type="text" class="form-control" id="inlineFormInputGroupUsername"
                        value="  ' .$info->buy_price. '" >
                    </div>
                </div>
                
                <div class="col-12">
                    <button name="edit" type="submit" class="btn btn-primary">Done</button>
                
                </div>
           
            </form>

        </div>
        ';
    }
}

?>



    </div>
               

    </div>
    <div class="col-14">
                    
                    <a class="btn btn-primary" style=" width:50%;  " href="reports.php">Reports --></a>
                
                </div>


</body>
<?php
            
            if(isset($_POST['add']))
            {
                if($product->check($_POST['product_name']))
                {
                    $product->update($_POST['product_name'],$_POST['price'],$_POST['number'],$_POST['catagory'],$_POST['buy_price']);

                }
                else
                {
                    $product->add($_POST['product_name'],$_POST['price'],$_POST['number'],$_POST['catagory'],$_POST['buy_price']);

                }
                
               
            }
            if(isset($_POST['edit']))
            $product->update($_SESSION['product_name'],$_POST['price'],$_POST['number'],$_POST['catagory'],$_POST['buy_price']);

        }
        else
        header("location:index.php");
        ?>


</html>