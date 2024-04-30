 <!-- Spinner Start -->
 <div id="spinner" class="show w-100 vh-100 position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
 	<div class="spinner-grow text-primary" role="status"></div>
 </div>
 <!-- Spinner End -->

 <div class="fix_menu mobile bg-white py-2" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
 	<div class="row px-2">
 		<div class="col text-center">
 			<a href="<?= PC::BASE_URL ?>Home">
 				<span class="btn btn-sm shadow-none">
 					<i class="bi bi-house"></i><br>
 					<?= isset($_SESSION['log']) ? "Dashboard" : "Home" ?>
 				</span>
 			</a>
 		</div>
 		<?php if (isset($_SESSION['log'])) { ?>
 			<div class="col text-center">
 				<a href="<?= PC::BASE_URL ?>Portfolio_Main" class="btn btn-sm shadow-none">
 					<i class="bi bi-briefcase"></i><br>
 					Portfolio
 				</a>
 			</div>
 			<div class="col text-center">
 				<a href="<?= PC::BASE_URL ?>Marketplace" class="btn btn-sm shadow-none">
 					<i class="bi bi-shop-window"></i><br>
 					Marketplace
 				</a>
 			</div>
 		<?php } else { ?>
 			<div class="col text-center">
 				<span class="btn btn-sm shadow-none">
 					<i class="bi bi-box-arrow-in-right"></i><br>
 					<a class="text-dark" href="<?= PC::BASE_URL ?>Login">Login</a>
 				</span>
 			</div>
 		<?php } ?>
 	</div>
 </div>