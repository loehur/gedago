<?php
$menu = [
	[
		"label" => "Wallet",
		"list" =>
		[
			[
				"label" => "Deposit",
				"group" => "Wallet",
				"active" => "Deposit",
				"link" => "Deposit"
			],
			[
				"label" => "Withdraw",
				"active" => "Wallet | Deposit",
				"link" => "#"
			]
		]
	],
	[
		"label" => "Investment",
		"list" =>
		[
			[
				"label" => "Dashboard",
				"active" => "Home",
				"link" => "Home"
			],
			[
				"label" => "Portfolio",
				"active" => "Portfolio",
				"link" => "#"
			],
			[
				"label" => "Marketplace",
				"active" => "Marketplace",
				"link" => "Marketplace"
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
				"link" => "#"
			],
			[
				"label" => "Bank Account",
				"active" => "Account | BA",
				"link" => "#"
			],
			[
				"label" => "Members",
				"active" => "Account | Members",
				"link" => "#"
			]
		]
	]
];
