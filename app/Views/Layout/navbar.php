<?php
$t = $data['title'];
?>

<style>
	.fix_menu {
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;
		text-align: center;
		background-color: white;
		z-index: 9999;
	}

	.dropdown-menu {
		min-width: 100px !important;
	}

	.dropdown-item {
		padding: 0px 5px !important;
		font-size: 12px !important;
	}
</style>

<!-- Navbar start -->
<div class="fixed-top shadow-sm bg-white" style="max-height: 80px;">
	<div class="container px-0">
		<nav class="navbar navbar-light navbar-expand-sm">
			<div class="container-fluid pt-2">
				<div class="row">
					<div class="col">
						<?php if (!isset($_SESSION['log'])) { ?>
							<a href="<?= PC::BASE_URL ?>Home">
								<h3 class="fw-bold text-dark"><?= PC::APP_NAME ?></h3>
							</a>
						<?php } else { ?>
							<button class="btn shadow-none ps-0" data-bs-toggle="offcanvas" href="#menu_page"><i class="bi bi-list"></i> Menu</button>
						<?php } ?>
					</div>
				</div>
				<div class="row pe-2">
					<?php if (isset($_SESSION['log'])) { ?>
						<div class="col-auto px-1">
							<div class="btn-group">
								<a href="#" class="btn btn-sm pt-2 me-1 bg-white shadow-sm" data-bs-toggle="dropdown">
									Logged in: <b class="text-primary"><?= ucfirst(strtok($_SESSION['log']['nama'], " ")); ?></b>
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="<?= PC::BASE_URL ?>Login/logout">Logout</a></li>
								</ul>
							</div>

						</div>
					<?php } else { ?>
						<div class="col-auto px-1 desktop">
							<a href="<?= PC::BASE_URL ?>Login" class="btn btn-sm pt-2 bg-white shadow-sm border-bottom fw-bold">
								Login
							</a>
						</div>
						<div class="col-auto px-1 desktop">
							<a href="<?= PC::BASE_URL ?>Register" class="btn btn-sm pt-2 bg-white shadow-sm border-bottom fw-bold">
								Register
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</nav>
	</div>
</div>
<!-- JavaScript Libraries -->
<script src="<?= PC::ASSETS_URL ?>js/jquery-3.7.0.min.js"></script>