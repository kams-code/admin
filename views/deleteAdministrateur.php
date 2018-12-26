<div class="main-panel">
<div class="content">
<?php 
//var_dump($_REQUEST['id_administrateur']);
Administrateur::deleteAdministrateur($_REQUEST['id_administrateur']);
header("Location: ../admin/listAdministrateur");
?>
</div>
</div>