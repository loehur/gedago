<?php

if (isset($_SESSION['log'])) {
	$d = $this->db(0)->get_where_row("portfolio", "user_id = '" . $_SESSION['log']['user_id'] . "' AND port_status = 0");
	$level = $d['level'] ?? 0;
}
?>
<div class="offcanvas offcanvas-start" tabindex="-1" id="menu_page" style="width: 300px;">
	<div class="bg-white pt-3 border-end" style="height: 100%;">
		<div class="offcanvas-header w-100">
			<div class="w-100">
				<div class="w-100 text-center">
					<i class="bi bi-wallet"></i> Main Wallet <br>
					<button class="btn shadow-none ps-0">
						<h5 class="fw-bold">Rp<span class="balance_amount">0</span></h5>
					</button>
				</div>
				<div class="border border-warning rounded px-3 py-2 bg-light w-100 text-center">
					Invenstment Level<br>
					<h5 class="text-success fw-bold"><span class="level_name"></span></h5>
					<small><span><?= isset($_SESSION['portfolio']['expired_date']) ? "Expired Date: " . $_SESSION['portfolio']['expired_date'] : '' ?></span></small>
				</div>
			</div>
		</div>
		<?php include_once("menu.php"); ?>

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
								<?php foreach ($m['list'] as $l) { ?>
									<div class="row">
										<div class="col p-0">
											<a href="<?= PC::BASE_URL ?><?= $l['link'] ?>"><button class="text-start <?= $m['active'] . $l['link'] == $data['title'] ? "fw-bold text-primary" : "" ?> btn shadow-none w-100"><?= $l['label'] ?></button></a>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance/<?= $level ?>");
		$("span.level_name").load("<?= PC::BASE_URL ?>Load/level_name/<?= $level ?>");
		spinner(0);
	});
</script>