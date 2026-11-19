<?php

	// Copyright (C) 2014-2019 Jacob Barkdull
	// Copyright (C) 2026 Manel Guerra
	//
	//	Jacob Barkdull released this work into the public domain.
	//	Manel Guerra likewise releases this modified version into the
	//	public domain.
	//	This applies worldwide. If this is not legally possible, we grant any
	//	entity the right to use this work for any purpose, without any
	//	conditions, unless such conditions are required by law.
	//
	//  --------------------
	//
	//  NOTICE:
	//
	//	To retain your settings when downloading or otherwise upgrading 
	//	to a new version of HashOver-md, it is recommended that you
	//	preserve this file, unless directed otherwise.


	// Various Settings
	$root_dir	= '/hashover-md/';					// HTTP root directory for comments
	$language	= 'en';						// Language used for forms, buttons, links, and tooltips
	$name		= 'GNU Knows Who';				// Nickname when one isn't given
	$template	= 'default';					// Comment layout template
	$page_title	= 'yes';					// Whether page title is shown or not
	$short_dates	= 'yes';					// Whether comment dates are shortened
	$icons		= 'yes';					// Whether comments have avatar icons (Gravatar)
	$icon_size	= '45';						// Size of Gravatar icons in pixels
	$indention	= 'left';					// Side to add comment indention on
	$rows		= '5';						// Default comment box height in rows
	$top_cmts	= '2';						// Number of comments allowed to become popular
	$spam_IP_check	= 'php';					// Options 'javascript' / 'php' for respective modes, or 'both'
	$expire		= time() + 60 * 60 * 24 * 30;			// Cookies' expiration date
	$domain		= $_SERVER['HTTP_HOST'];			// Domain name for refer checking & notifications
	$noreply_email	= 'noreply@example.com';			// E-mail used when no e-mail is given
	$user_reply	= 'no';						// Whether given e-mails are sent as reply-to address to users

	// Change to root directory
	chdir(dirname(__FILE__) . '/../');

	// Timezone
	date_default_timezone_set('America/Los_Angeles');

?>
