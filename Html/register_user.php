<section id="section-form-register">
    <h3 class="title-register">Register</h3>
    <form class="form-register" action="Controller/User/RegisterController.php" method="POST">
        <input type="text" name="first_name" placeholder="First Name">
        <input type="text" name="last_name" placeholder="Last Name">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_repeat" placeholder="Password - Repeat">
        <input type="submit" class="btn info" name="register" value="register">
    </form>
</section>