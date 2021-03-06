<?php
require_once('../private/initialize.php');

$page_title = 'MovieTime - Home Page';
$page = "index.php";
?>
<?php include(PUBLIC_PATH . '/users/login.php'); ?>
<?php include(PUBLIC_PATH . '/users/new.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>



<!--     Change this to show list of images -->
<div class="container-fluid text-center">    
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p><img src="<?php echo url_for("images/avengers poster.jpeg") ?>" class="img-thumbnail img" alt=Avengers_Poster"> Watch the Lastest Avengers movie with your friends NOW</p>
            <p><img src="<?php echo url_for("images/got poster.jpg") ?>" class="img-thumbnail img" alt="GOT_Poster"> Watch the Lastest GOT series with your friends NOW</p>
            <p><img src="<?php echo url_for("images/Justice league poster.jpg") ?>" class="img-thumbnail img" alt="Justice League Poster"> Watch the Lastest Justice League movie with your friends NOW</p>
        </div>

        <!--            Anything that should be in middle of page goes here-->
        <div class="col-sm-8 text-left"> 

            <br>
            <br> 
            <br>
            <br>
            <div class="container-fluid "> 
                <h1 class=" text-center" style="font-weight: lighter">  
                    Join the Biggest Film Community In the World.
                </h1>
            </div>
            <br>
            <br>
            <br>

            <!--                                        Code to get drop down list of countries-->

            <!--        Creates sign-up & login form-->
            <div class="container">
                <div class="row" style="text-align:center; position: relative; right: 80px">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-login">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="#" class="active" id="login-form-link">Login</a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="#" id="register-form-link">Register</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--                                                                                                **Action should be included once the page is created-->
                                        <form id="login-form" action="" method="post" role="form" style="display: block;">
                                            <?php echo $error; ?>
                                            <div class="form-group">
                                                <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="">
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                                <label for="remember"> Remember Me</label>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-sm-6 col-sm-offset-3">

                                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <!--                                                                                                                                    ****Include page for forgot password later-->
                                                            <a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <form id="register-form" action="" method="post" role="form" style="display: none;">
                                            <?php echo display_errors($errors); ?>
                                            <div class="form-group">
                                                <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First name" value="<?php echo $user['first_name'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="Last name" value="<?php echo $user['last_name'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" id="username" tabindex="2" class="form-control" placeholder="Username" value="<?php echo $user['username'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="Email Address" value="<?php echo $user['email'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" tabindex="4" class="form-control" placeholder="Password" >
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password_check" id="confirm-password" tabindex="5" class="form-control" placeholder="Confirm Password">
                                            </div> 
                                            <div class="form-group">
                                                <input type="date" name="date_of_birth" id="confirm-password" tabindex="6" class="form-control" placeholder="Date Of Birth" value="<?php echo $user['date_of_birth'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="address_line_1" id="confirm-password" tabindex="7" class="form-control" placeholder="Address Line 1" value="<?php echo $address['address_line_1'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="postcode" id="confirm-password" tabindex="8" class="form-control" placeholder="Postcode" value="<?php echo  $address['postcode'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <h4>City</h4>  
                                                <select name="city_id">
<?php
$city_set = find_all_cities();
while ($city = mysqli_fetch_assoc($city_set)) {
    echo "<option value=" . $city["city_id"] . ">"
    . h($city["city_name"]) . "</option>";
}
mysqli_free_result($city_set);
?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="register-submit" id="register-submit" tabindex="6" class="form-control btn btn-register" value="Register Now">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
        <div class="col-sm-2 sidenav">
            <div class="well">
                <p><img src="<?php echo url_for("images/jumanji.jpg") ?>" class="img-thumbnail img" alt="Jumanji Poster"> Watch the Lastest Jumanji movie with your friends NOW</p>

            </div>
            <div class="well">
                <p><img src="<?php echo url_for("images/pitch.jpg") ?>" class="img-thumbnail img" alt="pitch Poster"> Watch the Latest Pitch Perfect with your friends NOW</p>
            </div>
            <div class="well">
                <p><img src="<?php echo url_for("images/starwars.jpg") ?>" class="img-thumbnail img" alt="stars Poster"> Watch the Lastest Starwars movie with your friends NOW</p>
            </div>
        </div>
    </div>
</div>








<br>
<br>
<br>
<br>
<br>
<br>
<br>




<?php include(SHARED_PATH . '/footer.php'); ?>
