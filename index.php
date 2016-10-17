<?php include('header.php'); ?>

<div id="master">
	<?php
	if (isset($_GET['pag'])) {
	    @include $_GET['pag'] . ".php";
	} else {
	    @include "home.php";
	}
	?>
</div>

<?php include('footer.php'); ?>