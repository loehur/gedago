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
				"label" => "Bank Account",
				"active" => "Account | BA",
				"link" => ""
			],
			[
				"label" => "Members",
				"active" => "Account | Members",
				"link" => ""
			]
		]
	]
];
