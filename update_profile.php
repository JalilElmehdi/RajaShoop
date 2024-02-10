<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email already taken!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
      }
   }

   if(!empty($number)){
      $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
      $select_number->execute([$number]);
      if($select_number->rowCount() > 0){
         $message[] = 'number already taken!';
      }else{
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
      }
   }
   
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
   $select_prev_pass->execute([$user_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = $_POST['confirm_pass'];
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
         }
      }
   } 
   if (empty($message)) {
      header('location: profil.php');
   } 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

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
      <h1>Update Profil</h1>
      <form method="post" action="">
        <div class="txt_field">
          <input type="text" name="name" value="<?= $fetch_profile['name']; ?>">
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="text" name="number" value="<?= $fetch_profile['number']; ?>">
          <span></span>
          <label>Number</label>
        </div>
        <div class="txt_field">
          <input type="password" name="old_pass" value="<?= $fetch_profile['password']; ?>"  maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>Old Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="new_pass" placeholder="enter your new password"  maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>New Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="confirm_pass" placeholder="confirm your new password"  maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
          <span></span>
          <label>Confirm New Password</label>
        </div>
        
        <input type="submit" value="update now" name="submit">

      </form>
    </div>
<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>