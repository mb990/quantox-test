<?php
require_once ('../../classes/Database.php');
require_once ('../../classes/User.php');
$title = 'Register';
include APPROOT . INC .'/header.php';
?>

<?php include '../inc/pageheading.php'; ?>

<?php
  
  $user = new User('', '', '', '');
  
  // error variables
  $name_err = '';
  $email_err = '';
  $password_err = '';
  $confirm_password_err = '';

  

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $user->name = trim($_POST['name']);
    $user->email = trim($_POST['email']);
    $user->password = trim($_POST['password']);
    $user->confirm_password = trim($_POST['confirm_password']);

    if(empty($user->email)){
      $email_err = 'Please enter email';
    } else {
      
      $sql = 'SELECT id FROM users WHERE email = :email';

      if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if($stmt->execute()){
         
          if($stmt->rowCount() === 1){
            $email_err = 'Email is already taken';
          }
        } else {
          die('Something went wrong');
        }
      }

      unset($stmt);
    }

    if(empty($user->name)){
      $name_err = 'Please enter name';
    }

    if(empty($user->password)){
      $password_err = 'Please enter password';
    } elseif(strlen($user->password) < 6){
      $password_err = 'Password must be at least 6 characters ';
    }

    if(empty($user->confirm_password)){
      $confirm_password_err = 'Please confirm password';
    } else {
      if($user->password !== $user->confirm_password){
        $confirm_password_err = 'Passwords do not match';
      }
    }

    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
      
      $user->password = password_hash($user->password, PASSWORD_DEFAULT);
      // $user->hash_password($user->password);

      $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';

      if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':name', $user->name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $user->email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->password, PDO::PARAM_STR);

        if($stmt->execute()){
          header('location: login');
        } else {
          die('Something went wrong');
        }
      }
      unset($stmt);
    }

    // Close connection
    unset($pdo);
  }

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user->name; ?>">
    <span class="invalid-feedback"><?php echo $name_err; ?></span>
  </div>
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user->email; ?>">
    <span class="invalid-feedback"><?php echo $email_err; ?></span>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user->password; ?>">
    <span class="invalid-feedback"><?php echo $password_err; ?></span>
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty(confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user->confirm_password; ?>">
    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
  </div>

  <div class="form-row">
    <div class="col">
      <input type="submit" value="Register" class="btn btn-success btn-block">
    </div>
    <div class="col">
      <a href="login" class="btn btn-light btn-block">Have an account? Login</a>
    </div>
  </div>
</form>
</div>
<?php

include APPROOT . INC . '/footer.php';

?>