<?php

if (isset($_SESSION['log'])) {
	$d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $_SESSION['log']['user_id'] . "' AND port_status = 0");
	$level = $d['level'] ?? 0;
?>
	<div class="offcanvas offcanvas-start" tabindex="-1" id="menu_page" style="width: 230px;">
		<div class="bg-warning bg-opacity-75" style="height: 100%;">
			<br>
			<br>
			<br>
			<br>
			<?php include_once("menu.php"); ?>
			<div class="offcanvas-body px-0">
				<?php foreach ($menu as $k => $m) {
					if (isset($m['list'])) { ?>
						<div class="accordion" id="<?= $k ?>">
							<div class="accordion-item border-0 bg-transparent">
								<h2 class="accordion-header" id="heading<?= $k ?>">
									<button class="accordion-button fw-bold py-2 bg-transparent shadow-none <?= str_contains($data['title'], $m['active']) ? "" : "collapsed" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $k ?>" aria-expanded="<?= str_contains($data['title'], $m['active']) ? "true" : "false" ?>">
										<div class="float-start" style="width: 25px;"><?= $m['icon'] ?></div> <?= $m['label'] ?>
									</button>
								</h2>
								<div id="collapse<?= $k ?>" class="accordion-collapse collapse <?= str_contains($data['title'], $m['active']) ? "show" : "" ?>" data-bs-parent="#accord_menu">
									<div class="accordion-body py-0 bg-transparent" style="padding-left: 32px;">
										<?php foreach ($m['list'] as $l) { ?>
											<div class="row">
												<div class="col">
													<a href="<?= PC::BASE_URL ?><?= $l['link'] ?>"><button class="text-start <?= $m['active'] . $l['link'] == $data['title'] ? "fw-bold text-light" : "fw-bold" ?> btn shadow-none w-100"><?= $l['label'] ?></button></a>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div>
							<a style="padding: 8px 19px;" class="text-start <?= str_contains($data['title'], $m['active']) ? "fw-bold text-light" : "fw-bold" ?> btn shadow-none w-100" href=" <?= PC::BASE_URL ?><?= $m['link'] ?>">
								<div class="float-start" style="width: 25px;"><?= $m['icon'] ?></div> <?= $m['label'] ?>
							</a>
						</div>
				<?php }
				} ?>
			</div>
		</div>
	</div>
<?php
}
?>