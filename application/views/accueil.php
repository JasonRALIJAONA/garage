<div class="hero-wrap ftco-degree-bg" style="background-image: url('<?php echo base_url('assets/images/bg_1.jpg') ?>');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">Réparation et entretien de votre voiture, rapide et facile</h1>
	            <p style="font-size: 18px;">Un petit fleuve nommé Duden coule près de notre garage et nous approvisionne en pièces nécessaires. C'est un lieu idéal où votre voiture reçoit les meilleurs soins et l'attention qu'elle mérite</p>
            </div>
          </div>
        </div>
      </div>
    </div>
images
     <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-12	featured-top">
    				<div class="row no-gutters">
	  					<div class="col-md-4 d-flex align-items-center">
                <?php if (isset($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <form class="request-form ftco-animate bg-primary" method="post" action="<?php echo site_url('reservation/process_reservation'); ?>">
                  <h2>Prenez votre rendez-vous</h2>  
                    <div class="form-group mr-2">
                    <label for="service_id" class="label">Type de service:</label>
                    <select name="service_id" id="service_id" class="form-control">
                      <?php foreach ($services as $service): ?>
                          <option style="color: black;" value="<?php echo $service['id']; ?>"><?php echo $service['type']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    </div><br>
                    <div class="form-group mr-2">
                      <label for="date_debut" class="label">Date et heure de début:</label>
                      <input type="datetime-local" name="date_debut" id="date_debut" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
			                <input type="submit" value="Reserver" class="btn btn-secondary py-3 px-4">
			              </div>
                </form>
	  					</div>
	  					<div class="col-md-8 d-flex align-items-center">
	  						<div class="services-wrap rounded-right w-100">
	  							<h3 class="heading-section mb-4">Une meilleure façon de réserver et faire des réparations parfaites</h3>
	  							<div class="row d-flex mb-4">
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Choisissez la date de rendez-vous</h3>
				                </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Selectionnez les réparations qui vous convient</h3>
					              </div>
					            </div>      
					          </div>
					          <div class="col-md-4 d-flex align-self-stretch ftco-animate">
					            <div class="services w-100 text-center">
				              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
				              	<div class="text w-100">
					                <h3 class="heading mb-2">Reservez à l'avance les slots disponibles</h3>
					              </div>
					            </div>      
					          </div>
					        </div>
					        <p><a href="#" class="btn btn-primary py-3 px-4">Prenez votre rendez-vous</a></p>
	  						</div>
	  					</div>
	  				</div>
				</div>
  		</div>
    </section>


    <!-- <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">What we offer</span>
            <h2 class="mb-2">Feeatured Vehicles</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="carousel-car owl-carousel">
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo base_url('') ?>assets/images/car-1.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Mercedes Grand Sedan</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Cheverolet</span>
			    						<p class="price ml-auto">$500 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo base_url('') ?>assets/images/car-2.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Mercedes Grand Sedan</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Cheverolet</span>
			    						<p class="price ml-auto">$500 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo base_url('') ?>assets/images/car-3.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Mercedes Grand Sedan</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Cheverolet</span>
			    						<p class="price ml-auto">$500 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo base_url('') ?>assets/images/car-4.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Mercedes Grand Sedan</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Cheverolet</span>
			    						<p class="price ml-auto">$500 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
		    					</div>
		    				</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section> -->

    <section class="ftco-section ftco-about">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('<?php echo base_url('assets/images/about.jpg') ?>');">
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section heading-section-white pl-md-5">
	          	<span class="subheading">À PROPOS DE NOUS</span>
	            <h2 class="mb-4">Bienvenue chez AutoMecano</h2>
	            <p>Situé au bord d'un charmant ruisseau, notre garage est l'endroit idéal pour prendre soin de votre véhicule. Chez AutoMecano, nous vous offrons un service rapide et facile pour réserver à l'avance et choisir le type de réparation dont vous avez besoin.</p>
	            <p>En chemin vers notre garage, vous découvrirez un lieu où chaque détail compte. Nos experts sont là pour vous fournir un service de qualité, et vous garantir que votre véhicule sera entre de bonnes mains. Nous nous engageons à vous offrir une expérience de réparation sans souci et à répondre à toutes vos attentes. Bienvenue chez AutoMecano, où votre satisfaction est notre priorité.</p>
	            <p><a href="#" class="btn btn-primary py-3 px-4">Prenez votre rendez-vous</a></p>
	          </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Services</span>
            <h2 class="mb-3">Nos Derniers Services

            </h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Réparation Mécanique</h3>
                <p>Profitez de nos services de réparation mécanique de haute qualité. Situé près d'un charmant ruisseau, notre garage est équipé de tout le nécessaire pour prendre soin de votre véhicule.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Entretien Préventif</h3>
                <p>Pour assurer la longévité de votre véhicule, nous offrons des services d'entretien préventif complets. Notre garage, niché au bord d'un petit fleuve, est le lieu idéal pour vos besoins en entretien.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Diagnostic et Réparation Électronique</h3>
                <p>Nous proposons des services de diagnostic et de réparation électronique pour tous types de véhicules. Situé à proximité d'un petit fleuve, notre atelier est équipé des dernières technologies pour vous offrir un service précis et efficace.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Révision Complète</h3>
                <p>Pour une tranquillité d'esprit totale, nous offrons une révision complète de votre véhicule. Notre garage, situé près d'un petit ruisseau, est le meilleur endroit pour garantir que votre véhicule fonctionne parfaitement.</p>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-intro" style="background-image: url('<?php echo base_url('assets/images/bg_3.jpg')?>');">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Voulez-vous gagner avec nous ? Ne tardez plus.</h2>
            <a href="#" class="btn btn-primary btn-lg">Devenez membre</a>
          </div>
				</div>
			</div>
		</section>


    <!-- <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-3">Happy Clients</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(<?php echo base_url('') ?>assets/images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(<?php echo base_url('') ?>assets/images/person_2.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(<?php echo base_url('') ?>assets/images/person_3.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(<?php echo base_url('') ?>assets/images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap rounded text-center py-4 pb-5">
                  <div class="user-img mb-2" style="background-image: url(<?php echo base_url('') ?>assets/images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
<br>	


      <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery-migrate-3.0.1.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.easing.1.3.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.waypoints.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.stellar.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/owl.carousel.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.magnific-popup.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/aos.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.animateNumber.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js')?>"></script>
      <script src="<?php echo base_url('assets/js/jquery.timepicker.min.js')?>"></script>
      <script src="<?php echo base_url('assets/js/scrollax.min.js')?>"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
      <script src="<?php echo base_url('assets/js/google-map.js')?>"></script>
      <script src="<?php echo base_url('assets/js/main.js')?>"></script>