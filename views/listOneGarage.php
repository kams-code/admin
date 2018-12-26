
    <div class="main-panel">
		


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <?php foreach (Garage::listOneGarage($_REQUEST['id_garage']) as $garage)
                                          {?>
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title"><?=$garage["nom"]?> <?=$garage["prenom"]?>
                                  <br />
                        
                                  </h4>
                                </div>
                                <p class="description text-center">
                                <?=$garage["description"]?> <br>
                                   
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>12<br /><small>Files</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>2GB<br /><small>Used</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>24,6$<br /><small>Spent</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php } ?> 
                    <div class="col-lg-8 col-md-7">
                        <?php foreach (Garage::listOneGarage($_REQUEST['id_garage']) as $garage)
                                          {?>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile garagiste</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>nom du garage</label>
                                                <input type="text" name="nom" class="form-control border-input" disabled placeholder="Company" value="<?=$garage["nomGarage"]?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>nom du garagiste</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Username" value="<?=$garage["nom"]?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label>prenom</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?=$garage["prenom"]?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>telephone</label>
                                                <input type="text" class="form-control border-input"disabled  placeholder="Email" value="<?=$garage["telephone"]?>">
                                           
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               <label>Address</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Home Address" value="<?=$garage["adresse"]?>">
                                           
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                     <?php } ?> 
                        <div class="content">
                             <div class="header">
                                <h4 class="title">Edit Profile chauffeur</h4>
                            </div>
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>casier</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="Creative Code Inc.">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Username" value="michael23">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control border-input" disabled placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Company" value="Chet">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Last Name" value="Faker">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Home Address" value="Melbourne, Australia">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="City" value="Melbourne">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Country" value="Australia">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="number" class="form-control border-input" disabled placeholder="ZIP Code">
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
