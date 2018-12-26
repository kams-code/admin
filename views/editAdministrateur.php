<div class="main-panel">
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">modifier un administrateur</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                               
                                <form method="POST" action="administrateur/editAdministrateur">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>nom</label>
                                                <input type="text" class="form-control border-input" name="nom" required placeholder="entrez votre nom">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>prenom</label>
                                                <input type="text" class="form-control border-input" name="prenom" required placeholder="entrez votre prenom" >
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">login</label>
                                                <input type="email" class="form-control border-input" name="login" required placeholder="entrez votre login">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>mot de passe</label>
                                                <input type="password" class="form-control border-input"name="password" required placeholder="entrez votre password">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <input type="hidden" class="form-control border-input" name="password" required placeholder="entrez votre password" value="<?php $_REQUEST['idadministrateur'] ?>">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">modifier</button>
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

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script>

</html>
