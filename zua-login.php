<?php 
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $user_id = filter_input(INPUT_POST, 'password');
    $error_username = NULL;
    $error_password = NULL;

    if(empty($username)) {
        $error_username = 'Please enter your username';
    }
    if(empty($password)) {
        $error_password = 'Please enter your password';
    }

    if(empty($error_username) && empty($error_password)) {
        if(is_valid_admin_login($username, $password)) {
            $lifetime = 60 * 60 * 24 * 7; //one week
            session_set_cookie_params($lifetime, '/');
            session_start();
            $_SESSION['is_valid_admin'] = true;

            header('Location: zua-admin.php');
        }else {
            $error_username = 'Is not a valid username';
        }
    }

?>
<?php include 'view/header-admin.php' ?>

<main>
    <h2>Please fill in your credentials to login</h2>
 
    <form action="" id="register_form">
    <label>Username:*</label> <?php echo $error_username; ?>
    <input type="text" name="username">
    <label>Password:*</label> <?php echo $error_password; ?>
    <input type="text" name="password">
    <input type="submit" value="Sign In" class="button blue">
    </form>

<p>* Indicates a required field.</p>
</main>
<?php include 'view/footer.php' ?>