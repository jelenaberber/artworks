<div class="col-12 pl-0 d-flex justify-content-around">
    <form name="login-form" id="login-form" class="col-8 col-md-4 purple mt-5 pt-5 pb-3 bg-light" method="POST" action="models/login.php">
        <h2 class="col-12 mb-5 text-center">Log in</h2>
        <div class="container-fluid col-12">
            <input type="email" name="email" id="logEmail" class="container border-bottom-green  py-3 mt-2" placeholder="Email"/>
            <label id="emailMessage"></label>
            <input type="password" name="password" id="logPassword" class="container border-bottom-green py-3 mt-2" placeholder="Password"/>
            <label id="passwordMessage"></label>
            <div class="d-flex align-items-center flex-column py-3">
                <input type="submit" name="login-button" id="login-button" class="btn btn-light rounded-0" value="Log in">
            </div>
            <div id="odgovor"></div>
        </div>
    </form>
</div>