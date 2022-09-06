<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 my-5 border rounded-2 px-5">
            <h1 class="text-center my-3">Enter your details to register</h1>
            <form action="<?= PAGE_PATH. 'register__post' ?>" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" name="register_email" class="form-control" placeholder="john.doe@example.com"> 
                    <label for="Email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="register_name" class="form-control" placeholder="John Doe"> 
                    <label for="Name">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="register_password" class="form-control" placeholder="password"> 
                    <label for="Password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="register_password_confirm" class="form-control" placeholder="password"> 
                    <label for="Password">Confirm Password</label>
                </div>
                <div class="form-group my-3">
                    <input type="submit" value="Register" class="btn btn-primary btn-lg">
                </div>
            </form>
        </div>
    </div>
</div>