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
				"access" => "dp",
			],
			[
				"label" => "Withdraw (CS)",
				"active" => "Withdraw (CS)",
				"link" => "Withdraw_CS",
				"access" => "wd_1",
			],
			[
				"label" => "Withdraw (SuperAdmin)",
				"active" => "Withdraw (SA)",
				"link" => "Withdraw_SA",
				"access" => "wd_f",
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
				"access" => "uc",
			],
			[
				"label" => "Operation",
				"active" => "Operation",
				"link" => "Operation",
				"access" => "op",
			],
			[
				"label" => "Notification",
				"active" => "Notification",
				"link" => "Notif",
				"access" => "no",
			],
			[
				"label" => "Deposit Bank",
				"active" => "Bank",
				"link" => "Bank",
				"access" => "ba",
			],
			[
				"label" => "Investing Level",
				"active" => "Level",
				"link" => "Level",
				"access" => "lv",
			],
			[
				"label" => "Video List",
				"active" => "Video",
				"link" => "Video",
				"access" => "vd",
			],
		]
	],
];
