
<?php
require_once('../private/initialize.php');

$page_title = 'Genres-Event';
$page ="event_genres.php";
    

?>
<?php include(SHARED_PATH . '/header.php'); ?>
    
        
        <div class="container text-center">
            <div class=" content">
                <br> 
                <h1> Film Genres</h1>
                                 
                    <table id="my_Table1"> 
                            <tbody>  
                              <tr>  
                                <td>
                                    <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_1'>Action</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>  
                                <td>
                                    <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_2'>Adventure</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>  
                                <td>
                                     <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_3'>Comedy</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>                             
                              </tr>                  
                            </tbody> 
                            
                    </table> 
                <br>
                <br>
                    <table id="my_Table2"> 
                            <tbody>  
                              <tr>  
                                <td>
                                    <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_4'>Crime</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>  
                                <td>
                                    <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_5'>Drama</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>  
                                <td>
                                     <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_6'>Horror</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>                             
                              </tr>                  
                            </tbody> 
                            
                    </table> 
                
                
                <br>
                <br>
                    <table id="my_Table3"> 
                            <tbody>  
                              <tr>  
                                <td>
                                    <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_7'>Musical</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>  
                                <td>
                                    <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_8'>Sci-Fi</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>  
                                <td>
                                     <div class="col-lg-3">
                                        <div class="hovereffect">
                                            <img class="img-responsive" src="<?php echo url_for("images/got poster.jpg")?>" alt="">
                                            <div class="overlay">
                                               <h2 name='genre_9'>War</h2>
                                               <a class="info" href="#">link here</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>                             
                              </tr>                  
                            </tbody> 
                            
                    </table>

            </div>  
        </div>
  <?php include(SHARED_PATH . '/footer.php'); ?>    
        
             
        
      

