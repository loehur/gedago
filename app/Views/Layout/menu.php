<?php
$menu = [
	[
		"label" => "Dashboard",
		"active" => "Home",
		"link" => "Home",
		"icon" => '<i class="bi bi-grid-fill"></i>'
	],
	[
		"label" => "Portfolio",
		"active" => "Portfolio",
		"link" => "Portfolio_Main",
		"icon" => '<i class="bi bi-floppy-fill"></i>'
	],
	[
		"label" => "Wallet",
		"active" => "Wallet, ",
		"icon" => '<i class="bi bi-wallet-fill"></i>',
		"list" =>
		[
			[
				"label" => "Deposit",
				"link" => "Deposit"
			],
			[
				"label" => "Withdraw",
				"link" => "Withdraw"
			],
			[
				"label" => "History",
				"link" => "History"
			]
		]
	],
	[
		"label" => "Store",
		"active" => "Store",
		"link" => "Marketplace",
		"icon" => '<i class="bi bi-shop"></i>'
	],
	[
		"label" => "Account",
		"active" => "Account, ",
		"icon" => '<i class="bi bi-person-fill"></i>',
		"list" =>
		[
			[
				"label" => "Profil",
				"link" => "Profil"
			],
			[
				"label" => "Bank Account",
				"link" => "Bank"
			],
			[
				"label" => "Members",
				"link" => "Members"
			]
		]
	],
	[
		"label" => "Logout",
		"active" => "Logout",
		"link" => "C_sess/logout",
		"icon" => '<i class="bi bi-box-arrow-right"></i>'
	],

];
