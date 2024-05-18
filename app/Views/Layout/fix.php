 <!-- Spinner Start -->
 <div id="spinner" class="show w-100 vh-100 position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
 	<div class="spinner-grow text-primary" role="status"></div>
 </div>
 <!-- Spinner End -->

 <div class="fixed-bottom fix_menu mobile bg-dark py-1 bg-gradient shadow" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
 	<div class="row px-2">
 		<?php if (isset($_SESSION['log'])) { ?>
 			<div class="col text-center">
 				<a href="<?= PC::BASE_URL ?>Home" class="text-warning btn btn-sm shadow-none <?= "Home" == $data['title'] ? "fw-bold text-white" : "" ?>">
 					<i class="bi bi-grid-fill"></i><br>
 					Dashboard
 				</a>
 			</div>
 			<div class="col text-center">
 				<a href="<?= PC::BASE_URL ?>Portfolio_Main" class="text-warning btn btn-sm shadow-none <?= "Portfolio" == $data['title'] ? "fw-bold text-white" : "" ?>">
 					<i class="bi bi-briefcase"></i><br>
 					Portfolio
 				</a>
 			</div>
 			<div class="col text-center">
 				<a href="<?= PC::BASE_URL ?>Marketplace" class="text-warning btn btn-sm shadow-none <?= "Store" == $data['title'] ? "fw-bold text-white" : "" ?>">
 					<i class="bi bi-shop-window"></i><br>
 					Store
 				</a>
 			</div>
 		<?php }  ?>
 	</div>
 </div>