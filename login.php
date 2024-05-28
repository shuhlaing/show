<?php
  session_start();
  require 'config/config.php';
  require 'config/common.php';

  if($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stat = $pdo->prepare("SELECT * FROM users WHERE email=:email");

    $stat->bindValue(':email',$email);
    $stat->execute();
    $user = $stat->fetch(PDO::FETCH_ASSOC);

    //print_r($user);
    if($user){
        if(password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = 0;
        $_SESSION['logged_in'] = time();

        header("Location: index.php");
      }
    }
    echo "<script>alert('Incorrect credentials.')</script>";
  }
 ?>



 <!doctype html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Live Show Login Form - User</title>
     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome Icons -->

     <!-- Theme style -->
     <link rel="stylesheet" href="dist/css/custom.css">

 </head>

 <body>
     <div id="particles-js" class="snow"></div>

     <main>
        <div class="left-side"></div>

       <div class="right-side">
         <form action="login.php" method="post">
          <input name="_token" type="hidden" value="<?php echo ($_SESSION['_token']); ?>">
         <div class="or">Login</div>

         <label for="email">Email</label>
         <input type="email" name="email" class="form-control" placeholder="Email" required>

         <label for="password">Password</label>
         <input type="password" name="password" class="form-control" placeholder="Password" required>

         <button type="submit" class="login-btn" value="SUBMIT">Login</button>
         <p class="mb-0">
           <a href="register.php" class="text-center">Register a new membership</a>
         </p>
       </form>
       </div>

     </main>
     <!-- AdminLTE App -->
     <script src="dist/js/custom.js"></script>
   </body>

 </html>
