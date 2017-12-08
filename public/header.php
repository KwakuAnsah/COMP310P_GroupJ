<!DOCTYPE html>

<!--
Each element containing inline style should be added to external stylesheet-->





<html lanh="eng">
    <head>
        <title> MovieTime</title>
        
<!--        Adds bootstrap libary and jQuery and javascript-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device width, intial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
          <div class="container text-center "> 
        
            <h1 style="display: inline; font-size:500%;" >MovieTime     </h1>
            
<!--            <img src="new_logo.jpg" alt="image of logo" height="150px" style="display: inline;">-->
         </div>
        
        
        
<!--        Creates & centers the navigation bar  & makes sure black strip fills the screen width-->
        <div class="container-fluid">
            <nav class="navbar   navbar-inverse  ">         
<!--                  <div class="navbar-header">
                    <a class="navbar-brand" href="#">WebSiteName</a>
                  </div>-->
                    
                                
                    <div class="container" style="text-align:">  
                        <ul class="nav navbar-nav" style="text-align:center; position: relative; display: inline-block; left: 200px">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">What's on</a></li>
                            <li><a href="#">Locations</a></li> 
                            <li><a href="#">Film Genres </a></li>
                             <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                        
<!--                        Form to submit  user search -->
                         <form class="navbar-form navbar-left" action="/action_page.php" style="text-align:center; position: relative; display: inline-block; left: 230px">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                      <div class="input-group-btn">
                                          <button class="btn btn-default" type="submit">
                                                    <i class="glyphicon glyphicon-search"></i>
                                          </button>
                                      </div>
                                </div>
                        </form>                     
                    </div>                              
            </nav>
        </div>  


 

        
        
         
             
       
    </body>
    
</html>



<!--Creates grid -->
<!--
<div class="container"> 
             <div class="row">
                 <div class="col-md-2" style='background-color: #ff9999' style="height: 30%; "> What's on </div>
                 <div class="col-md-2" style='background-color: #ff2999'> Locations </div>
                 <div class="col-md-2" style='background-color: #ff9999'> Film Genres </div>
                 <div class="col-md-2" style='background-color: #99ccff'> About Us </div>
                 <div class="col-md-2" style='background-color: #00cc99'> Contact Us </div>
                 <div class="col-md-2" style='background-color: #ff9999'> Search </div>
              </div>
              
         </div>-->