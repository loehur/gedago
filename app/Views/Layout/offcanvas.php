<div class="offcanvas offcanvas-start" tabindex="-1" id="menu_page" style="max-width: 300px;">
	<div class="offcanvas-header w-100">
		<div class="w-100">
			<div class="w-100 text-center">
				<i class="bi bi-wallet"></i> Main Wallet <br>
				<button class="btn shadow-none ps-0">
					<h5 class="fw-bold">Rp99.665</h5>
				</button>
			</div>
			<div class="border rounded px-3 py-2 bg-light w-100 text-center">
				Active Investment <br>
				<h5>Level <i class="bi bi-3-circle-fill text-primary"></i></h5>
			</div>
		</div>
	</div>
	<?php
	$menu = [
		[
			"label" => "Wallet",
			"list" =>
			[
				[
					"label" => "Deposit",
					"active" => "Wallet | Deposit",
					"link" => ""
				],
				[
					"label" => "Withdraw",
					"active" => "Wallet | Deposit",
					"link" => ""
				]
			]
		],
		[
			"label" => "Investment Products",
			"list" =>
			[
				[
					"label" => "Level 1",
					"active" => "IP | Level 1",
					"link" => ""
				],
				[
					"label" => "Level 2",
					"active" => "IP | Level 2",
					"link" => ""
				],
				[
					"label" => "Level 3",
					"active" => "IP | Level 3",
					"link" => ""
				],
			]
		],
		[
			"label" => "Account",
			"list" =>
			[
				[
					"label" => "Profil",
					"active" => "Account | Profil",
					"link" => ""
				],
				[
					"label" => "Bank Payment",
					"active" => "Account | BP",
					"link" => ""
				],
				[
					"label" => "Members",
					"active" => "Account | Members",
					"link" => ""
				]
			]
		]
	]
	?>

	<div class="offcanvas-body">
		<div class="accordion" id="accord_menu">
			<?php foreach ($menu as $k => $m) { ?>
				<div class="accordion-item">
					<h2 class="accordion-header" id="heading<?= $k ?>">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $k ?>">
							<?= $m['label'] ?>
						</button>
					</h2>
					<div id="collapse<?= $k ?>" class="accordion-collapse collapse" data-bs-parent="#accord_menu">
						<div class="accordion-body">
							<?php foreach ($m['list'] as $l) { ?>
								<div class="row">
									<div class="col p-0">
										<button class="text-start btn shadow-none w-100"><?= $l['label'] ?></button>
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
<script>
	$(document).ready(function() {
		spinner(0);
	});
</script>