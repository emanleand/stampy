<h3>Formulario de Registro de Usuario</h3>
<div class="container"></div>
    <div class="form">
        <form action="Controller/User/RegisterController.php" method="POST">
                                    
            <div class= "group">
                <input type="text" name="first_name" class= "form-control" placeholder="First Name">
            </div>
            <div class= "group">
                <input type="text" name="last_name" class= "form-control" placeholder="Last Name">
            </div>
            <div class= "group">
                <input type="text" name="username" class= "form-control" placeholder="Username">
            </div>
            <div class= "group">
                <input type="text" name="email" class= "form-control" placeholder="Email">
            </div>                        
            <div class= "group">
                <input type="password" name="password" class= "form-control" placeholder="Password">
            </div>                        
            <div class= "group">
                <input type="password" name="password_repeat" class= "form-control" placeholder="Password - Repeat">
            </div>                        
            <div class="group">
                <input type="submit" class="btn btn-success btn-block" name="save_task" value="Register">
            </div>
        </form>                    
    </div>        
</div>