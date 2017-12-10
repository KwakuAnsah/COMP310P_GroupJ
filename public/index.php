
<!DOCTYPE html>

<html lang="eng">
    <head>
         <?php require_once('../private/initialize.php'); ?>
        <?php $page_title = 'MovieTime - Home Page'; ?>



            <title> MovieTime</title>

        <?php include "bootstrap.php";?>
 
<!--    CSS to style login/register form-->
        <link rel="stylesheet for login form" href="index CSS.css">
<!--    CSS to style sidenav-->
        <link rel="stylesheet for sidenav" href="index sidenav CSS.css">
<!--    JS for Login/register form -- async used so script is executed as soon as it's downloaded, without blocking the browser in the meantime.-->
        <script type="text/javascript" src="index-login script.js" async></script>       
    </head>

    <body>

  <?php include "header.php";?>       
        
      
<!--     Change this to show list of images -->
        <div class="container-fluid text-center">    
          <div class="row content">
            <div class="col-sm-2 sidenav">
                <p><img src="avengers poster.jpeg" class="img-thumbnail img" alt=Avengers_Poster"> Watch the Lastest Avengers movie with your friends NOW</p>
                <p><img src="got poster.jpg" class="img-thumbnail img" alt="GOT_Poster"> Watch the Lastest GOT series with your friends NOW</p>
                <p><img src="Justice league poster.jpg" class="img-thumbnail img" alt="Justice League Poster"> Watch the Lastest Justice League movie with your friends NOW</p>
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
                                                                                                        <div class="form-group">
                                                                                                                <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
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
                                                                                                         <div class="form-group">
                                                                                                             <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First name">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                             <input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="Last name">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <input type="text" name="username" id="username" tabindex="2" class="form-control" placeholder="Username" value="">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="Email Address" value="">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <input type="password" name="password" id="password" tabindex="4" class="form-control" placeholder="Password">
                                                                                                        </div>
                                                                                                        <div class="form-group">
                                                                                                                <input type="password" name="confirm-password" id="confirm-password" tabindex="5" class="form-control" placeholder="Confirm Password">
                                                                                                        </div>
                                                                                                    
<!--                                                                                                    Doesn't work-->
                                                                                                        <div class="form-group">
                                                                                                           <select id="countries_states1" class="input-medium bfh-countries" data-country="US"></select>
                                                                                                           <select class="input-medium bfh-states" data-country="countries_states1"></select>
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
                <p>ADS</p>
              </div>
              <div class="well">
                <p>ADS</p>
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
        
        

    
    </body>



    <?php include(SHARED_PATH . '/footer.php'); ?>
</html>


  <!--    ****************** Will remove later ***************-->
    <!--    <h1> MovieTime: Coming Soon</h1>
        <div id="content">
            This will be the What's On/Home Page <br><br><br>

            Need to implement a search bar, list of upcoming events with filtering 
            options <br><br>        

            <h4>Home Page Few Highligted Events related links:</h4>
            Then there's a list of upcoming events say 9 events. Each is a link to 
            the specific view event page <br>
            <li><a href="<?php echo url_for('/events/show.php?id=1'); ?>">View Event 1</a></li> 
            - this link would eventually be dynamic but for now it goes to event with id=1

            <h4>Search Bar related links:</h4>
            <li><a href="<?php echo url_for('/search_results.php'); ?>">Search Results</a></li>
            <br><br><br>

            And just while i havent got the CRUD pages working yet (anything to do with user, event, bookings)
            just note that: <br><br>

            the user page would link to:
            <li><a href="<?php echo url_for('/bookings/show.php'); ?>">View a Booking</a></li>
            <li><a href="<?php echo url_for('/bookings/delete.php'); ?>">Delete a Booking</a></li>
            <li><a href="<?php echo url_for('/bookings/edit.php'); ?>">Edit a Booking</a></li>
            <br><br>

            the view booking page would link to:
            <li><a href="<?php echo url_for('/events/show.php'); ?>">View a Booking</a></li>
            <br><br>

            the event page would link to:
            <li><a href="<?php echo url_for('/bookings/new.php'); ?>">New Booking</a></li>
            <br><br>
     </div>-->
