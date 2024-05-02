<?php
$menu = [
	[
		"label" => "Finance Approval",
		"list" =>
		[
			[
				"label" => "Deposit",
				"active" => "Deposit",
				"link" => "Deposit",
				"access" => 10,
			],
			[
				"label" => "Withdraw (CS)",
				"active" => "Withdraw (CS)",
				"link" => "Withdraw_CS",
				"access" => 10,
			],
			[
				"label" => "Withdraw (SuperAdmin)",
				"active" => "Withdraw (SA)",
				"link" => "Withdraw_SA",
				"access" => 0,
			],
		]
	],
	[
		"label" => "Setting",
		"list" =>
		[
			[
				"label" => "Admin User",
				"active" => "Admin User",
				"link" => "Admin_User",
				"access" => 0,
			],
		]
	],
];
