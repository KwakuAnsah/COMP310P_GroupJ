
<!DOCTYPE html>

<html lang="eng">
    <head>
         <?php require_once('../private/initialize.php'); ?>    
        <?php $page_title = 'MovieTime - Home Page'; ?>

            <title> Whats On</title>

        <?php include "bootstrap.php";?>
        <!--    CSS to style sidenav-->
        <link rel="stylesheet for sidenav & whats on page" href="whats_on CSS.css">  
    
    </head>
    
    <body> 
       
         <?php include "header.php";?>     
        
        <div class="container-fluid text-center">
            <div class="row content">
<!--                <div class="col-sm-3 sidenav">
                   <p> Watch the Lastest Avengers movie with your friends NOW</p>
                   <p><img src="got poster.jpg" class="img-thumbnail img" alt="GOT_Poster"> Watch the Lastest GOT series with your friends NOW</p>
                   <p><img src="Justice league poster.jpg" class="img-thumbnail img" alt="Justice League Poster"> Watch the Lastest Justice League movie with your friends NOW</p>
                </div>-->
                <br>
                <br> 
                <h1 class='whats_on_title'>What's On</h1>
                
          <!--          Table with data-->
                    
                    <table class='table table-striped' id="myTable" >  
                            <thead>  
                              <tr>  
                                <th>Event Name</th>  
                                <th>Event End</th>  
                                <th>Event Description</th>  
                                <th>Total Tickets</th>  
                                <th>Event Start</th>  
                                <th>Ticket Sale End</th>  
                              </tr>  
                            </thead>  
                <!--       Use PHP to input data-->
                            <tbody>  
                              <tr>  
                                <td>Spooky Movie Marathon</td>  
                                <td>2018-01-19 02:00:00</td>  
                                <td>Spooky Movie Night in the Buttercup Room</td>  
                                <td>16</td>  
                                <td>2018-01-18 18:00:00</td> 
                                <td>2018-01-18 17:00:00</td>  
                              </tr>
                               <tr>  
                                <td>Fun ACADEMY DINOSAUR Screening!</td>  
                                <td>2017-12-08 23:00:00</td>  
                                <td>Come along and watch Academy Dinosaur with me!</td>  
                                <td>17</td>  
                                <td>2017-12-08 17:00</td> 
                                <td>2017-12-08 16:45:00</td>  
                              </tr>
                            </tbody> 
                            
                    </table> 
<!--           Will add to JS below to seperate file later-->
                    <script>
                    $(document).ready(function(){
                        $('#myTable').dataTable();
                    });
                    </script>
            </div>  
        </div>
      
        
             
        
    </body>
    
        
         
</html>    

