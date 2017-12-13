<?php
require_once('../../private/initialize.php');

$page_title = 'Events - Host';
$page ="host_events.php";
   
if (!isset($_GET['host_user_id'])) {
    redirect_to(url_for('/index.php'));
}
$host_user_id = $_GET['host_user_id'];
?>
<?php include(SHARED_PATH . '/header.php');?>
     
<!--        Asynchronous searching used on this page-->
        <div class="container-fluid text-center">
            <div class="row content">
                <br>
                <br> 
                <h1 class='whats_on_title'>What's On</h1>
                
          <!--          Table with data-->
                    
                    <table class='table table-striped' id="myTable" >  
                            <thead>  
                              <tr>  
                                <th>Event Name</th> 
                                <th> Host User_id</th>
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
                                <td>1</td>
                                <td>2018-01-19 02:00:00</td>                              
                                <td>Spooky Movie Night in the Buttercup Room</td>  
                                <td>16</td>  
                                <td>2018-01-18 18:00:00</td> 
                                <td>2018-01-18 17:00:00</td>  
                              </tr>
                               <tr>  
                                <td>Fun ACADEMY DINOSAUR Screening!</td> 
                                <td>3</td>
                                <td>2017-12-08 23:00:00</td>  
                                <td>Come along and watch Academy Dinosaur with me!</td>  
                                <td>17</td>  
                                <td>2017-12-08 17:00</td> 
                                <td>2017-12-08 16:45:00</td>  
                              </tr>
                            </tbody> 
                            
                    </table> 
            </div>  
        </div>
      
<?php include(SHARED_PATH . '/footer.php'); ?>

