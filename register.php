<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass']; // Password is not hashed here
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass']; // Password is not hashed here
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/styleslide.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
<div class="center">
      <h1>Register</h1>
      <form method="post" action="">
        <div class="txt_field">
          <input type="text" name="name" required  maxlength="50">
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="email" name="email" required   maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="text" name="number" required   min="0" max="9999999999" maxlength="10">
          <span></span>
          <label>Number</label>
        </div>
        <div class="txt_field">
          <input type="password" name="pass" required   maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="cpass" required   maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>Password</label>
        </div>
        
        <input type="submit" value="Register" name="submit">
        <div class="signup_link">
        already have an account? <a href="login.php">Login Now</a>
        </div>
      </form>
    </div>












<?php include 'components/footer.php'; ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>