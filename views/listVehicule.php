<div class="main-panel">
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Liste des vehicules</h4>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
            
                                    	<th>nom du vehicule</th>
                                        <th>couleur du vehicule</th>
                                        <th>categorie du vehicule</th>
                                        <th>action</th>
                                        
                                        
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            foreach (vehicule::listVehicule() as $vehicule) {
                                                ?>
                                                    <tr>
                                                        
                                                        <td><?=$vehicule["nomvehicule"]?></td>
                                                        <td><?=$vehicule["couleurvehicule"]?></td>
                                                        <td><?=$vehicule["categorieVehicule"]?></td>
                                                        
                                                        <td>
                                                            <a href="listOneChauffeur/?id_chauffeur=<?=$chauffeur["idchauffeur"]?>">
                                                                <i class="ti-pencil-alt">detail</i>
                                                            </a>
                                                            <a href="deleteChauffeur/?id_chauffeur=<?=$chauffeur["idchauffeur"]?>">
                                                                <i class="ti-close">supprimer</i>
                                                            </a>
                                                           
                                                </td>
                                                        
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>

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
