<?php
if (isset($data['parse'])) {
	$parse = $data['parse'];
} else {
	$parse = null;
}
?>

<!DOCTYPE html>
<html>
<?php include_once("head.php"); ?>

<body class="bg-light">
	<?php include_once("fix.php"); ?>
	<?php include_once("navbar.php"); ?>
	<?php include_once("offcanvas.php"); ?>
	<div style="margin-top: 80px;padding-bottom:80px; z-index:1" id="content"></div>
	<?php include_once("footer.php"); ?>
</body>

</html>

<!-- JavaScript Libraries -->
<script src="<?= PC::ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>
<script src="<?= PC::ASSETS_URL ?>plugins/bootstrap-5.1/bootstrap.bundle.min.js"></script>

<script>
	$(document).ready(function() {
		content("<?= $parse ?>");
		cart_count();
		user_name();
		device();
	});

	function content(parse = "") {
		$("div#content").load('<?= PC::BASE_URL ?><?= $con ?>/content/' + parse);
	}

	function cart_count() {
		$("div#cart_count").load('<?= PC::BASE_URL ?>Load/cart');
	}

	function user_name() {
		$("span#user_name").load('<?= PC::BASE_URL ?>Load/account');
	}

	function spinner(mode) {
		if (mode == 0) {
			$("div#spinner").addClass("d-none");
		} else {
			$("div#spinner").removeClass("d-none");
		}
	}

	function device() {
		let mobile = false;

		if (window.screen.width < 500) {
			mobile = true;
		}

		if (mobile == true) {
			$(".mobile").css("display", "inline");
		} else {
			$(".desktop").css("display", "inline");
			$("div#menu_page").removeClass();
			$("div#menu_page").removeAttr('style');
			$("div#menu_page").css({
				'top': '0',
				'width': '300px',
				'z-index': '3',
				'height': '100vh'
			});
			$("div#menu_page").addClass("position-fixed pe-3");
		}
	}
</script>