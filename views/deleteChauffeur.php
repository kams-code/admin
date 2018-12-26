<div class="main-panel">
<div class="content">
<?php 

Garage::deleteChauffeur($_REQUEST['id_chauffeur']);
header("Location: ../admin/listChauffeur");
?>
</div>
</div>