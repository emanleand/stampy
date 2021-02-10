<section id="section-form-register">
    <h3 class="title-register">Register</h3>
    <h3 id="error-register" class="title-login"></h3>
    <input id="user" type="text" name="user" style="display: none;">
    <form id="form-register" class="form-register" method="POST">
        <input id="first-name" type="text" name="firstName" placeholder="First Name">
        <input id="last-name" type="text" name="lastName" placeholder="Last Name">
        <input id="username" type="text" name="username" placeholder="Username">
        <input id="email" type="text" name="email" placeholder="Email">
        <input id="password" type="password" name="password" placeholder="Password">
        <input id="password-repeat" type="password" name="password_repeat" placeholder="Password - Repeat">
        <input type="submit" class="btn info" id="button-register" name="register" value="register">
        <input type="submit" class="btn info" id="button-update" name="update" value="update" style="display: none;">
    </form>
</section>