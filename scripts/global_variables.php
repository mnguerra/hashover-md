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


	$subfile_count	= array();	// Individual comment thread count
	$cmt_count	= '1';		// Comment count excluding replies
	$total_count	= '1';		// Comment count including replies
	$show_cmt	= '';		// Will contain all comments

	// Characters to be removed from name, email, and website fields
	$search = array('<', '>', "\n", "\r", "\t", '&nbsp;', '&lt;', '&gt;', '"', "'", '\\');
	$replace = array('', '', '', '', '', '', '', '', '&quot;', '&#39;', '');

?>
