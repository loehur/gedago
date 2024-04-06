<?php
$t = $data['title'];
?>

<!-- Navbar start -->
<div class="fixed-top shadow-sm" style="max-height: 80px; background-color:aliceblue">
	<div class="container px-0">
		<nav class="navbar navbar-light navbar-expand-xl">
			<div class="container-fluid">
				<a href="<?= PC::BASE_URL . $_GET['url'] ?>" class="navbar-brand">
					<img src="<?= PC::ASSETS_URL ?>img/logo.png" class="img-logo-home px-2" alt="">
				</a>
				<div class="navbar-toggler border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2">
					<span class="fa fa-bars"></span>
				</div>
				<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
					<div class="offcanvas-header">
						<a href="<?= PC::BASE_URL ?>CS" class="navbar-brand">
							<img src="<?= PC::ASSETS_URL ?>img/logo.png" class="img-logo-home px-2" alt="">
						</a>
						<button type="button" class="btn-close text-reset me-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<?php if (isset($_SESSION['log_admin'])) { ?>
							<a href="#" onclick="logout_admin()" class="ms-auto btn btn-sm border position-relative pt-2 me-1 bg-white shadow-none">
								Logout: <span class="text-success" id="user_name"></span>
							</a>
						<?php  } ?>
					</div>
				</div>
			</div>
		</nav>
	</div>
</div>
<!-- Navbar End -->

<script>
	function logout_admin() {
		$.post("<?= PC::BASE_URL ?>Session/logout_admin", function() {
			location.reload(true);
		});
	}
</script>