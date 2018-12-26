<div class="main-panel">
<div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>nom</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="nom" value="entrez votre nom">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>prenom</label>
                                                <input type="text" class="form-control border-input" placeholder="prenom" value="entrez votre prenom">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control border-input" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>telephone</label>
                                                <input type="text" class="form-control border-input" placeholder="telephone" value="entrez votre numero de telephone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>adresse</label>
                                                <input type="text" class="form-control border-input" placeholder="adresse" value="entrez votre adresse">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mot de passe</label>
                                                <input type="password" class="form-control border-input" placeholder="mot de passe" value="entrez votre mot de passe">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>sexe</label>
                                                <input type="text" class="form-control border-input" placeholder="sex" value="entrez votre sexe">
                                            </div>
                                        </div>
                                    </div>

                        
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">enregistrer</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
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
