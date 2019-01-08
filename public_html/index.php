<?php
 // include 'header.php';
 // include 'navbar.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Tambalo Furniture</title>
		<meta name="author" content=""/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="keywords" content="tambalofurniture.com"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta charset="utf-8">

		<link href="assets/images/logo.png" rel="shortcut icon" type="image/png" />
	    
	    <!-- stylesheet -->
	    <link href="assets/css/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="assets/css/font-awesome.css" rel="stylesheet">

		<script src="assets/js/jquery-1.8.1.min.js"></script>		
		 <script type="text/javascript">
		    $(function(){
		      SyntaxHighlighter.all();
		    });
		    $(window).load(function(){
		      $('.flexslider').flexslider({
		        animation: "slide",
		        controlNav: "thumbnails",
		        start: function(slider){
		          $('body').removeClass('loading');
		        }
		      });
		    });
		  </script>
	</head>
	<body>
		<div class="header">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header"> 
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button> 
				    <a class="navbar-brand logo" href="/">
				      	<span>Tambalo</span> 
				       	<h5>Furntiture</h5>
				    </a>
				</div><!-- navbar-header -->
				<div class="collapse navbar-collapse" id="collapse">
				    <ul class="nav navbar-nav navbar-right">
				        <li><a href="#featured">Home</a></li>
				        <li><a href="#about">About</a></li>
				        <li><a href="#services">Services</a></li>
				        <li><a href="#contact">Contact</a></li>
				    </ul>        
				</div><!-- collapse navbar-collapse -->
			</nav>

			<div class="content-bottom" id="featured">
				<div class=" backg">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-md-offset-4 inner col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
								<div class="text-box">
									<?php
							        	require 'config.php';
				                        $sql = "SELECT * FROM company limit 1";
				                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

				                        if(mysqli_num_rows($result) != 0) {
				                          while ($row = mysqli_fetch_assoc($result)) {
				                          	echo'
				                          		<p class="intro">Introducing</p>
				                          		<h2>'.$row['company_name'].'</h2>
				                          		<h3>'.$row['company_slogan'].'</h3>	
				                          		';
				                            }
				                        }
							        ?>
					            </div>
					  		</div>
				  		</div>
			  		</div>
				</div>
			</div> <!-- end of content-bottom -->
		</div> <!-- end of header -->

		<div class="content-bottom" id="featured">
			<div class="logo">
				<h1><span>Gallery</span> </h1>
			</div>	<!-- end of logo -->
			<div class="header_bottom">	
			  	<div class="wrap">	
					<section class="slider">
				        <div class="flexslider">
					        <ul class="slides">
					        <?php
					        	require 'config.php';
		                        $sql = "SELECT * FROM gallery";
		                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

		                        if(mysqli_num_rows($result) != 0) {
		                          while ($row = mysqli_fetch_assoc($result)) {
		                          	echo'
		                          		<li data-thumb='.$row['image_path'].'>
							  	    	    <img class="img" src='.$row['image_path'].' alt=""/>
							    		</li>
		                          		';
		                            }
		                        }
					        ?>
					            
						    </ul> <!-- end of slides -->
						</div> <!-- end of flexslider -->
					</section> <!-- end of slider -->
			   	</div> <!-- end of wrap -->
			</div> <!-- end of header bottom -->
		</div> <!-- end of content-bottom -->

		<div class="wrap">
		   	<div class="main">
				<div class="container">
				    <div id="about" class="content-bottom">		    
				    	<h1 class="section-header"><span></span> </h1>
				    	<div class="section group">
							<div class="col about barside">
								<h3>History</h3>
								<?php
						        	require 'config.php';
			                        $sql = "SELECT * FROM history ";
			                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

			                        if(mysqli_num_rows($result) != 0) {
			                          while ($row = mysqli_fetch_assoc($result)) {
			                          	echo'
			                          		<p>'.$row['history'].'</p>
			                          		';
			                            }
			                        }
						        ?>
								
							</div>
							<div class="barside leftside cont col span_2_of_3">
								<h3>Testimonials</h3>
								<!-- Start Testimonial section -->
								<section id="testimonial">
								    <!-- <img class="juan" src="views/images/product1.jpg" alt="img"> -->
								    <div class="counter-overlsay ">
								      <div class="container col-md-12">
								        <div class="row">
								          <div class="col-md-12">
								            <!-- Start Testimonial area -->
								            <div class="testimonial-area">
								              <div class="testimonial-conten">
								                <!-- Start testimonial slider -->
								                <div class="testimonial-slider">
								                  <!-- single slide -->
								                <?php
										        	require 'config.php';
							                        $sql = "SELECT * FROM testimonial ";
							                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

							                        if(mysqli_num_rows($result) != 0) {
							                          while ($row = mysqli_fetch_assoc($result)) {
							                          	echo'
							                          		<div class="single-slide">
											                    <p>'.$row['testimonial'].'</p>
											                    <div class="single-testimonial">
											                      <img class="testimonial-thumb" src='.$row['testimonial_img'].' alt="img">
											                      <p>'.$row['testimonial_name'].'</p>
											                      <span>'.$row['testimonial_title'].'</span>
											                    </div>
										                  	</div>
							                          		';
							                            }
							                        }
										        ?>
								                  
								                </div>
								              </div>
								            </div>
								          </div>
								        </div>
								      </div>
								    </div> 
								  </section> <!-- End Testimonial section -->
							</div>
						</div>
					</div> <!-- end of about -->
				</div>

				<div class="container">
					<div id="services" class="content-bottom">
					    <h1 class="section-header"><span></span></h1>
					    <div class="section group">
						<?php
				        	require 'config.php';
	                        $sql = "SELECT * FROM services limit 3";
	                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

	                        if(mysqli_num_rows($result) != 0) {
	                          while ($row = mysqli_fetch_assoc($result)) {
	                          	echo'
	                          		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 service-content"  >
									<img class=" img-circle" src='.$row['services_img_path'].'  alt=""/>
										<h3 data-toggle="modal" data-target="#'.$row['data_target'].'">'.$row['services_name'].'</h3>
										<p>'.$row['services_des'].'</p>
									</div>
	                          		';
	                            }
	                        }
				        ?>					    
							
						</div>
					</div> <!-- end of services -->
				</div> <!-- end of container -->

				<!-- start of modal -->
				<div id="sash" class="modal fade" role="dialog">
		            <div class="modal-dialog">
		                <div class="modal-content">
		                  	<div class="modal-header">
		                	<button type="button" class="close" data-dismiss="modal">&times;</button>
		                		<h2 class="modal-title">Sash Factory</h2>
		              		</div>
		                  	<div class="modal-body">
		                    	<div id="Sash"class="carousel slide" data-ride="carousel" data-interval="1000000">
			                    	<div class="carousel-inner">
			                    		<?php
								        	require 'config.php';
								        	include 'check.php';
					                        $sql = "SELECT * FROM sash";
					                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

					                        if(mysqli_num_rows($result) != 0) {
					                          while ($row = mysqli_fetch_assoc($result)) {
					                          		
					                          	echo'
					                          		<div class="'.$row['class'].'">
					                          			<img class="img img-responsive" src="'.$row['sash_img_path'].'" alt="Sash Factory">
					                          		</div>
					                          		';
					                            }
					                        }
								        ?>
			                     		      
			                    	</div><!-- carousel-inner -->

				                    <a class="left carousel-control" href="#Sash" role="button" data-slide="prev">
								      <span class="glyphicon glyphicon-chevron-left"></span>
								    </a>
								    <a class="right carousel-control" href="#Sash" role="button" data-slide="next">
								      <span class="glyphicon glyphicon-chevron-right"></span>
								    </a>
		                  		</div><!-- featured carousel -->
		                  </div>
		                  <div class="modal-footer">Tambalo Furniture</div>
		                </div>
		           	</div>
		        </div>	<!-- end of sash -->

		        <div class="modal fade" id="furniture" role="dialog">
			        <div class="modal-dialog">          
		            	<div class="modal-content">
				            <div class="modal-header">
				            	<button type="button" class="close" data-dismiss="modal">&times;</button>
				            	<h2 class="modal-title">Furniture</h2>
				            </div>
			              	<div class="modal-body">
				                <div id="Furniture"class="carousel slide" data-ride="carousel" data-interval="1000000">
				                    <div class="carousel-inner">
			                      		<?php
								        	require 'config.php';
					                        $sql = "SELECT * FROM furniture";
					                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

					                        if(mysqli_num_rows($result) != 0) {
					                          while ($row = mysqli_fetch_assoc($result)) {
					                          	echo'
					                          		<div class="'.$row['class'].'">
					                          			<img class="img img-responsive" src="'.$row['furniture_img_path'].'" alt="Furniture">
					                          		</div>
					                          		';
					                            }
					                        }
								        ?>
			                      	</div><!-- carousel-inner -->

				                    <a class="left carousel-control" href="#Furniture" role="button" data-slide="pclass="img" rev">
								      <span class="glyphicon glyphicon-chevron-left"></span>
								    </a>
								    <a class="right carousel-control" href="#Furniture" role="button" data-slide="next">
								      <span class="glyphicon glyphicon-chevron-right"></span>
								    </a>
				                </div><!-- featured carousel -->
			                </div>
		              		<div class="modal-footer">Tambalo Furniture</div>
		            	</div>
		          	</div> <!-- end modal-dialog -->
		        </div>	<!-- end of furniture -->

		       <div class="modal fade" id="general-contructing" role="dialog">
			        <div class="modal-dialog">          
		            	<div class="modal-content">
				            <div class="modal-header">
				            	<button type="button" class="close" data-dismiss="modal">&times;</button>
				            	<h2 class="modal-title">General Contructing</h2>
				            </div>
			              	<div class="modal-body">
				                <div id="generalcontructing"class="carousel slide" data-ride="carousel" data-interval="1000000">
				                    <div class="carousel-inner">
				                    	<?php
								        	require 'config.php';
					                        $sql = "SELECT * FROM general_contructing";
					                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

					                        if(mysqli_num_rows($result) != 0) {
					                          while ($row = mysqli_fetch_assoc($result)) {
					                          	echo'
					                          		<div class="'.$row['class'].'">
					                          			<img class="img img-responsive" src="'.$row['general_img_path'].'" alt="General Contructing">
					                          		</div>
					                          		';
					                            }
					                        }
								        ?>
			                      	</div><!-- carousel-inner -->

				                    <a class="left carousel-control" href="#generalcontructing" role="button" data-slide="prev">
								      <span class="glyphicon glyphicon-chevron-left"></span>
								    </a>
								    <a class="right carousel-control" href="#generalcontructing" role="button" data-slide="next">
								      <span class="glyphicon glyphicon-chevron-right"></span>
								    </a>
				                </div><!-- featured carousel -->
			                </div>
		              		<div class="modal-footer">Tambalo Furniture</div>
		            	</div>
		          	</div> <!-- end modal-dialog -->
		        </div>	<!-- end of furniture -->
		         
				<div class="container">
					<div id="contact" class="content-bottom">
						<h1 class="section-header"><span></span></h1>	
				    	<div class="section group">		
				    		<div class="col contact">
								<div class="contact_info">
							   	 	<h2>Find Us Here</h2>
								 		<div class="map">
								   			<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com.ph/maps/search/Brgy.+Barangobong,+Sta.+Lucia,+Ilocos+Sur/@17.1160448,120.4468322,17z/data=!3m1!4b1"></iframe><br><small><a class="large-map" href="https://www.google.com.ph/maps/search/Brgy.+Barangobong,+Sta.+Lucia,+Ilocos+Sur/@17.1160448,120.4468322,17z/data=!3m1!4b1" style="color:#666;text-align:left;font-size:12px"><p>View Larger Map</p></a></small>
								   		</div>
				      			</div>
				      			<div class="company_address address">
								   	<h2>Company Information :</h2>
								   	<p>Brgy. Barangobong,</p>
							   		<p>Sta. Lucia, Ilocos Sur,</p>
							   		<p>Phillippines</p>
							   		
								   	<?php
							        	require 'config.php';
				                        $sql = "SELECT * FROM company";
				                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

				                        if(mysqli_num_rows($result) != 0) {
				                          while ($row = mysqli_fetch_assoc($result)) {
				                          	echo'
				                          		<i class="fa fa-phone">
											   		<span> '.$row['contact'].'</span>
										   		</i>
				                          		';
				                            }
				                        }
							        ?>
								   		<i class="fa fa-facebook">
								   		<span><a href="https://www.facebook.com/elmer.tambalo?fref=ts"> Elmer Tambalo</a></span>
								   		</i>							   		
								</div>
							</div>	
							
								<div class="col span_2_of_3">
								  	<div class="contact-form">
								  		<h2>Contact Us</h2>
									    <form action="contact.php" method="post">
									    	
									    	<div>
										    	<span><label>E-mail</label></span>
										    	<span><input type="email" class="form-control" id="email" name="email" placeholder="Enter email" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" required></span>
										    </div>
									    	<div>
										    	<span><label>Name</label></span>
										    	<span><input type="test" class="form-control" id="fullname" name="fullname" placeholder="Enter fullaname" required></span>
										    </div> 								    
										    <div>
										    	<span><label>Subject</label></span>
										    	<span><textarea name="message" class="form-control inputs-fields" minlength="30" maxlength="500" style="height: 130px;" placeholder="What's on your mind ?" required> </textarea></span>
										    </div>
										   	<div>
										   		<button name="send" type="submit" class="btn btn-default pull-right">Send message</button>
										   	</div>
									    </form>
								    </div>
				  				</div>	
						</div> <!-- end of section group -->
					</div>  <!-- end of contact --> 	
				</div> <!-- end of container -->
			</div> <!-- end of main --> 
		</div>	<!-- end of wrap -->

		<div class="copy_right">
			<div class="wrap">
				<p><a href="/">Tambalo Furniture</a> © All Rights Reseverd</p>
			</div>
		</div>	<!-- end of copy right -->
		<script src="assets/js/jquery-1.10.1.min.js" type="text/javascript" ></script>
		<script src="assets/js/jquery.flexslider.js" defer ></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/myscript.js"></script>
		<script src="assets/js/slick.js" type="text/javascript"></script>
		<script src="assets/js/index.js" type="text/javascript"></script>
		<script src="assets/js/custom.js" type="text/javascript"></script>
	</body>
</html>

