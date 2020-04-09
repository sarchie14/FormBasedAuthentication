
<?php 
     require('model/admin_db.php');
    // Validate password strength

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');


  if(empty($username)) {
        $error_username = 'Please enter a username';
    }else if(strlen($username) < 6) {
        $error_username = 'Username needs to be more than 6 characters long';
    }

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(empty($password)) {
        $error_password = 'Please enter a password';
    }
    
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        $error_password = 'Your password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters';
    }
    
    if($password != $confirm_password) {
        $error_confirm_password = 'The password you entered did not match.';
    }

    if(empty($error_username) && empty($error_password) && empty($error_confirm_password)) {
       add_admin($username, $password);
        header('Location: zua-admin.php');
   }

?>
<?php include "view/header-admin.php" ;?>

<main>
    <h2>Register a new admin user</h2>

    <form action="" id="register_form" method="post">
    <label>Username:* </label>
    <input type="text" name="username"> <?php echo $error_username;?>
    <label>Password:* </label>
    <input type="text" name="password"><?php echo $error_password;?>
    <label>Confirm Password:* </label>
    <input type="text" name="confirm_password" ><?php echo $error_confirm_password;?>
    <input type="submit" value="Register" class="button blue">
    </form>

    <p>* Indicates a required field.</p>
</main>
<?php include "view/footer.php" ; ?>