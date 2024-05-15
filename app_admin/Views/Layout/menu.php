<?php
$menu = [
	[
		"label" => "Finance Approval",
		"active" => "Finance, ",
		"list" =>
		[
			[
				"label" => "Deposit",
				"link" => "Deposit",
				"access" => "dp",
			],
			[
				"label" => "Withdraw (CS)",
				"link" => "Withdraw_CS",
				"access" => "wd_1",
			],
			[
				"label" => "Withdraw (SuperAdmin)",
				"link" => "Withdraw_SA",
				"access" => "wd_f",
			],
		]
	],
	[
		"label" => "Data",
		"active" => "Data, ",
		"list" =>
		[
			[
				"label" => "Investor",
				"link" => "Investor",
				"access" => "d_in",
			],
			[
				"label" => "Video",
				"link" => "Video",
				"access" => "vd",
			],
		]
	],
	[
		"label" => "Setting",
		"active" => "Setting, ",
		"list" =>
		[
			[
				"label" => "Admin User",
				"link" => "Admin_User",
				"access" => "uc",
			],
			[
				"label" => "Operation",
				"link" => "Operation",
				"access" => "op",
			],
			[
				"label" => "Notification",
				"link" => "Notif",
				"access" => "no",
			],
			[
				"label" => "Deposit Bank",
				"link" => "Bank",
				"access" => "ba",
			],
			[
				"label" => "Investing Level",
				"link" => "Level",
				"access" => "lv",
			],
		]
	],
];
