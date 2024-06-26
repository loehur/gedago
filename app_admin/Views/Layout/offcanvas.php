<?php

include_once "menu.php";

if (isset($_SESSION['log_admin'])) { ?>
	<div class="offcanvas offcanvas-start" tabindex="-1" id="menu_page" style="width: 280px;">
		<div class="bg-white pt-3 border-end" style="height: 100%;">
			<div class="offcanvas-header w-100">
				<div class="w-100">
					<div class="row">
						<div class="row mb-3">
							<div class="col">
								<small>Admin Logged in</small><br>
								<span class="text-primary"><?= $_SESSION['log_admin']['nama'] ?></span>
							</div>
						</div>
						<hr>
					</div>
				</div>
			</div>
			<div class="offcanvas-body">
				<div class="accordion" id="accord_menu">
					<?php foreach ($menu as $k => $m) { ?>
						<div class="accordion-item">
							<h2 class="accordion-header" id="heading<?= $k ?>">
								<button class="accordion-button <?= str_contains($data['title'], $m['active']) ? "" : "collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $k ?>" aria-expanded="<?= str_contains($data['title'], $m['active']) ? "true" : "false" ?>">
									<?= $m['label'] ?>
								</button>
							</h2>
							<div id="collapse<?= $k ?>" class="accordion-collapse collapse <?= str_contains($data['title'], $m['active']) ? "show" : "" ?>" data-bs-parent="#accord_menu">
								<div class="accordion-body">
									<?php foreach ($m['list'] as $l) {
										if (in_array($l['access'], $_SESSION['log_admin']['privilege']) == true) { ?>
											<div class="row">
												<div class="col p-0">
													<a href="<?= PC::BASE_URL_ADMIN ?><?= $l['link'] ?>"><button class="text-start <?= $m['active'] . $l['link'] == $data['title'] ? "fw-bold text-primary" : "" ?> btn shadow-none w-100"><?= $l['label'] ?></button></a>
												</div>
											</div>
									<?php }
									} ?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>