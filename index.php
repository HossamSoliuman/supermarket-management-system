<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket mangement</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <div class="container">
        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
               
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="text" class="form-control" id="exampleInputPassword1">
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Enter</button>
        </form>

    </div>

    <?php
    
        if(isset($_POST['submit']))
        { 
            $_SESSION['worker_name']=$_POST['name'];
            
            include "model/users.php";
            $u=new user;
            if(!$u->check($_POST['name'],$_POST['password']))
            {
                echo "password or user name is wrong.....";               
            }
            else
            { 
               
                if($u->ismanager($_POST['name']))
                    header("location:manager.php");
                else 
                    header("location:worker.php");
                
            }
        }

        ?>

    </div>
</body>

</html>