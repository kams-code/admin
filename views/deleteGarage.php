<div class="main-panel">
<div class="content">
<?php 
//var_dump($_REQUEST['id_administrateur']);
Garage::deleteGarage($_REQUEST['id_garage']);
header("Location: ../admin/listGarage");
?>
</div>
</div>