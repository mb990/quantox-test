<?php
require_once '../../classes/Database.php';
$title = 'Login';
include APPROOT . INC .'/header.php';
?>

<?php include '../inc/pageheading.php'; ?>

<?php
 
  
  $email = '';
  $password = '';
  $email_err = '';
  $password_err = '';
   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
  
      if(empty($email)){
        $email_err = 'Please enter email';
      }
  
      if(empty($password)){
        $password_err = 'Please enter password';
      }
  
      if(empty($email_err) && empty($password_err)){
        
        $sql = 'SELECT name, email, password FROM users WHERE email = :email';
  
        if($stmt = $pdo->prepare($sql)){
          
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  
          if($stmt->execute()){
            
            if($stmt->rowCount() === 1){
              if($row = $stmt->fetch()){
                $hashed_password = $row['password'];
                if(password_verify($password, $hashed_password)){
                 
                  session_start();
                  $_SESSION['email'] = $email;
                  $_SESSION['name'] = $row['name'];
                  header('location: index');
                } else {
                  
                  $password_err = 'The password you entered is not valid';
                }
              }
            } else {
              $email_err = 'No account found for that email';
            }
          } else {
            die('Something went wrong');
          }
        }
        // Close statement
        unset($stmt);
      }
  
      // Close connection
      unset($pdo);
    }
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">   
<div class="form-group">
	<label for="email">Email Address</label>
	<input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
	<span class="invalid-feedback"><?php echo $email_err; ?></span>
</div>
<div class="form-group">
	<label for="password">Password</label>
	<input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
	<span class="invalid-feedback"><?php echo $password_err; ?></span>
</div>
<div class="form-row">
	<div class="col">
	<input type="submit" value="Login" class="btn btn-success btn-block">
	</div>
	<div class="col">
	<a href="register" class="btn btn-light btn-block">No account? Register</a>
	</div>
</div>
</form>
  </div>
<?php

include APPROOT . INC . '/footer.php';

?>