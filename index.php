<?php

/**
* @category user management
* @package Front
* @author emanleand@gmail.com
* @since 2020/02/03
*/

?>

<?php require_once('Html/header.php'); 
    session_start();
?>

<section class="main">		
    <!-- Register User -->
    <?php require_once('Html/User/register_user.php'); ?>

    <!-- Updater User -->
    <?php require_once('Html/User/update_user.php'); ?>
    
    <!-- Login User -->
    <?php require_once('Html/User/login_user.php'); ?>
    
    <!-- List User -->
    <?php require_once('Html/User/list_user.php'); ?>
</section>
<?php require_once('Html/footer.php'); ?>