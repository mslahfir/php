<?php
        session_start();
        require('db.php');

        if(isset($_SESSION['user'])) header('Location: dashboard.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con,$username); 
            
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con,$password);
            
            $department = stripslashes($_REQUEST['department']);
            $department = mysqli_real_escape_string($con,$department);

            if(empty($username))
            {
                echo '<div class="alert alert-danger alert-dismissable animate__animated animate__bounceIn" id="flash-msg">
                <h4>Enter username</h4>
                </div>';
            } else if(empty($password))
            {
                echo '<div class="alert alert-danger alert-dismissable animate__animated animate__bounceIn" id="flash-msg">
                <h4>Enter Password</h4>
                </div>';
            }else{
                $id = uniqid();
    
                $query = "INSERT into `registrations` (id, username, password, department) VALUES ('$id','$username', '$password', '$department')";
                $result = mysqli_query($con,$query);
    
                if($result){
                    echo '<div class="alert alert-success alert-dismissable animate__animated animate__bounceIn" id="flash-msg">
                    <h4>Registered</h4>
                    </div>';
                    $_SESSION["user"] = $username;
                    header('Location: dashboard.php');
                }
            }

        } 

        $con->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My first php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="http://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link href="./styles.css" rel="stylesheet" >
</head>
<body>
    <div class="container mt-4">
        <h1 class="fs-1 fw-bolder text-center">DYNAMIC PHP REGISTER</h1>
    </div>
    
    <div class="container d-flex mt-5">
        <?php  
            if(isset($message))  
            {  
                echo '<div class="alert alert-danger alert-dismissable animate__animated animate__bounceIn" id="flash-msg">
                    <h4>Error</h4>
                </div>'; 
            }  
        ?> 
        <form class="container p-2 bg-light shadow-lg rounded mx-3 my-3" method="POST" action="" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" >
            </div>
            <div class="my-4">
                <select class="form-select" aria-label="Default select example" name="department">
                    <option selected>Select Department</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Robotics">Robotics</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $("#flash-msg").delay(3000).fadeOut("slow");
        })
    </script>

</body>
</html>