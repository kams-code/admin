<div class="main-panel">
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Liste des administrateurs</h4>
                                
                                
                                    <a href="ajouterAdministrateur" style="align:top">
                                        <i class="ti-plus"></i>
                                        Ajouter
                                    </a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>nom</th>
                                    	<th>prenom</th>
                                    	<th>login</th>
                                        <th>mot de passe</th>
                                        <th>action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            foreach (Administrateur::listAdministrateur() as $administrateur) {
                                                ?>
                                                    <tr>
                                                        <td><?=$administrateur["nom"]?></td>
                                                        <td><?=$administrateur["prenom"]?></td>
                                                        <td><?=$administrateur["login"]?></td>
                                                        <td><?=$administrateur["password"]?></td>
                                                        <td>
                                                        <?php
                                                    echo '<a href="deleteAdministrateur/?id_administrateur=',$administrateur["idadministrateur"],'"
                                                    " onclick="return confirm(\'Etes vous sur ?\')"><i class="ti-close"></i></a>'?>
                                    
                                                    <a href="editAdministrateur/?id_administrateur=<?=$administrateur["idadministrateur"]?>">
                                                        <i class="ti-pencil-alt"></i>
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
