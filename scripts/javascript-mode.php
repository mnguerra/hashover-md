<?php

	// Copyright (C) 2014-2019 Jacob Barkdull
	// Copyright (C) 2026 Manel Guerra
	//
	//	This program is free software: you can redistribute it and/or modify
	//	it under the terms of the GNU Affero General Public License as
	//	published by the Free Software Foundation, either version 3 of the
	//	License, or (at your option) any later version.
	//
	//	This program is distributed in the hope that it will be useful,
	//	but WITHOUT ANY WARRANTY; without even the implied warranty of
	//	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	//	GNU Affero General Public License for more details.
	//
	//	You should have received a copy of the GNU Affero General Public License
	//	along with this program.  If not, see <http://www.gnu.org/licenses/>.


	// Tell browser output is JavaScript
	header ('Content-Type: application/javascript');

	// Disable browser cache
	header ('Expires: Wed, 08 May 1991 12:00:00 GMT');
	header ('Last-Modified: ' . gmdate ('D, d M Y H:i:s') . ' GMT');
	header ('Cache-Control: no-store, no-cache, must-revalidate');
	header ('Cache-Control: post-check=0, pre-check=0', false);
	header ('Pragma: no-cache');

?>
// @licstart  The following is the entire license notice for the
//  JavaScript code in this page.
//
// Copyright (C) 2014-2017 Jacob Barkdull
//
//	This program is free software: you can redistribute it and/or modify
//	it under the terms of the GNU Affero General Public License as
//	published by the Free Software Foundation, either version 3 of the
//	License, or (at your option) any later version.
//
//	This program is distributed in the hope that it will be useful,
//	but WITHOUT ANY WARRANTY; without even the implied warranty of
//	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//	GNU Affero General Public License for more details.
//
//	You should have received a copy of the GNU Affero General Public License
//	along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// @licend  The above is the entire license notice for the
//  JavaScript code in this page.
//
//--------------------
//
// Source Code and Installation Instructions:
//	http://<?php echo $domain . $_SERVER['PHP_SELF'] . "?source\n"; ?>


// Default form settings
if (rows	== undefined) { var rows	=  '<?php echo $rows; ?>'; }
if (name_on	== undefined) { var name_on	=  'yes'; }
if (email_on	== undefined) { var email_on	=  'yes'; }
if (sites_on	== undefined) { var sites_on	=  'yes'; }
//if (passwd_on	== undefined) { var passwd_on	=  'yes'; }

// Add comment stylesheet to page header
var head = document.getElementsByTagName('head')[0];
var links = document.getElementsByTagName('link');

if (document.querySelector('link[href="<?php echo $root_dir; ?>comments.css"]') == null) {
	link = document.createElement('link');
	link.rel = 'stylesheet';
	link.href = '<?php echo $root_dir; ?>comments.css';
	link.type = 'text/css';
	head.appendChild(link);
}

// Put number of comments into "cmtcount" identified HTML element
if (document.getElementById('cmtcount') != null) {
	if (<?php echo $total_count - 1; ?> != 0) {
		document.getElementById('cmtcount').innerHTML = '<?php echo $total_count - 1; ?>';
	}
}

// Displays reply form
function reply(r, f) {
	var form_html = '\n<span class="optionbuttons" style="float: right;">\n';

	if (name_on == 'yes' || email_on == 'yes' || sites_on == 'yes') {
		form_html += '<?php echo (isset($_COOKIE['name']) and !empty($_COOKIE['name'])) ? '<input type="button" value="&#x25BC; ' . $text['options'] . '" onClick="options(' . "\''+r+'\'" . '); this.value = (this.value == \\\'&#x25BC; ' . $text['options'] . '\\\') ? \\\'&#x25B2; ' . $text['options'] . '\\\' : \\\'&#x25BC; ' . $text['options'] . '\\\'; return false;">' : ''; ?>\n';
	}

//	form_html += '<input type="button" value="<?php echo $text['cancel']; ?>" onClick="cancelform(\''+r+'\'); return false;">\n\
	form_html += '</span>\n<b class="cmtfont"><?php echo $text['reply_to_cmt']; ?></b>\n\
	<span<?php echo (isset($_COOKIE['name']) and !empty($_COOKIE['name'])) ? ' style="max-height: 0px;"' : ''; ?> class="options" id="options-'+r+'">\n';

<?php if ($icons == 'yes') { ?>
	if (name_on == 'yes') {
		form_html += '<?php echo $avatar_image; ?>\n';
	}
<?php }?>

	if (name_on == 'yes') {
		form_html += '<input type="text" name="name" title="<?php echo $text['nickname_tip']; ?>" value="<?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : ''; ?>" maxlength="30" class="form-data opt-name" placeholder="<?php echo $text['nickname']; ?>">\n';
	}

	<?php if ($is_mobile == 'yes') echo 'form_html += \'</tr>\n<tr>\n\';'; ?>

	if (email_on == 'yes') {
		form_html += '<input type="text" name="email" title="<?php echo $text['email']; ?>" value="<?php echo (isset($_COOKIE['email'])) ? $_COOKIE['email'] : ''; ?>" class="form-data opt-email" placeholder="<?php echo $text['email']; ?>">\n';
	}

	if (sites_on == 'yes') {
		form_html += '<input type="text" name="website" title="<?php echo $text['website']; ?>" value="<?php echo (isset($_COOKIE['website'])) ? $_COOKIE['website'] : ''; ?>" class="form-data opt-website" placeholder="<?php echo $text['website']; ?>">\n';
	}

	form_html += '</span>\n\
	<textarea rows="6" cols="62" name="comment" placeholder="<?php echo $text['reply_form']; ?>" style="width: 100%;" title="<?php echo $text['cmt_tip']; ?>"></textarea><br>\n\
	<span class="button_area"><input class="post_cmt" type="submit" value="<?php echo $text['post_reply']; ?>" onClick="return noemailreply(\''+r+'\');" onsubmit="return noemailreply(\''+r+'\');">\n\<?php
	echo (isset($_GET['canon_url']) or isset($canon_url)) ? "\n\t" . '<input type="hidden" name="canon_url" value="' . $page_url . '">\n\\' . PHP_EOL : PHP_EOL; ?>
	<input type="hidden" name="cmtfile" value="' + f + '">\n\
	<input type="hidden" name="reply_to" value="'+f+'">\n\
	<input type="button" class="post_cmt" value="<?php echo $text['cancel']; ?>" onClick="cancelform(\''+r+'\'); return false;"></span>';

	document.getElementById('cmtopts-' + r).style.display = 'none';
	document.getElementById('cmtforms-' + r).innerHTML = form_html;
	document.getElementById('reply_form-' + r).comment.focus ();
	return false;
}

// Function to cancel reply and edit forms
function cancelform(f) {
	document.getElementById('cmtopts-' + f).style.display = '';
	document.getElementById('cmtforms-' + f).innerHTML = '';
	return false;
}

// Displays options
function options(r) {
	if (name_on == 'yes' || email_on == 'yes' || sites_on == 'yes') {
		if (document.getElementById('options-' + r).style.maxHeight != '200px') {
			document.getElementById('options-' + r).style.maxHeight = '200px';
		} else {
			document.getElementById('options-' + r).style.maxHeight = '0px';
		}
	}

	return false;
}

// Displays a "blank email address" warning
function noemail() {
	if (email_on == 'yes' && (document.comment_form.email.value == '')) {
		var answer = confirm('<?php echo $text['no_email_warn']; ?>');

		if (answer == false) {
			document.comment_form.email.focus();
			return false;
		}
	}
}

// Displays a "blank email address" warning when replying
function noemailreply(f) {
	if (email_on == 'yes' && (document.getElementById('reply_form-' + f).email.value == '')) {
		var answer = confirm('<?php echo $text['no_email_warn']; ?>');

		if (answer == false) {
			document.getElementById('options-' + f).style.display = '';
			document.getElementById('reply_form-' + f).email.focus();
			return false;
		}
	}
}

// Get page title
if (document.title != '') {
	var pagetitle = ' <?php echo $text['published_on']; ?> "'+document.title+'"';
} else {
	var pagetitle = '';
}

var show_cmt = '';

function parse_template(object, sort, method) {
	var indent = (sort == false || method == 'ascending') ? object['indent'] : '16px 0px 12px 0px';

    var
        root_dir = '<?php echo addcslashes($root_dir, "'"); ?>',
        permalink = object['permalink'],
        cmtclass = (sort == false || method == 'ascending') ? object['cmtclass'] : 'cmtdiv',
        avatar = object['avatar'],
        name = object['name'],
        thread = (object['thread']) ? object['thread'] : '',
        date = object['date'],
        edit_link = (object['edit_link']) ? object['edit_link'] : '',
        reply_link = object['reply_link'],
        comment = object['comment'],
        form = '',
        cmtopts_style = ''
    ;

<?php
    // Load HTML template
    $html_template = file_get_contents('html-templates/' . $template . '.html');

    // Convert HTML template line endings to system style
    $newline_search = array("\r\n", "\r", "\n");
    $newline_replace = array("\n", "\n", PHP_EOL);
    $html_template = str_replace($newline_search, $newline_replace, $html_template);

    // Break HTML template into individual lines
    $template_lines = explode(PHP_EOL, $html_template);

    // Echo each line as JavaScript variable addition
    for ($line = 0, $line_length = count($template_lines); $line < $line_length; $line++) {
        echo "\t\t" . 'show_cmt += \'' . $template_lines[$line] . '\n\';' . PHP_EOL;
    }
?>
}

function sort_comments(method) {
	var methods = {
		ascending: function() {
			for (var comment in comments) {
				parse_template(comments[comment], true, method);
			}
		},

		descending: function() {
			for (var comment = (comments.length - 1); comment >= 0; comment--) {
				parse_template(comments[comment], true, method);
			}
		},

		byname: function() {
			var tmpSortArray = comments.slice(0).sort(function(a, b) {
				if(a.sort_name < b.sort_name) return -1;
				if(a.sort_name > b.sort_name) return 1;
			})

			for (var comment in tmpSortArray) {
				parse_template(tmpSortArray[comment], true, method);
			}
		},

		bydate: function() {
			var tmpSortArray = comments.slice(0).sort(function(a, b) {
				return b.sort_date - a.sort_date;
			})

			for (var comment in tmpSortArray) {
				parse_template(tmpSortArray[comment], true, method);
			}
		}

	}

	show_cmt = '';
	document.getElementById('sort_div').innerHTML = 'Loading...' + '\n';
	methods[method]();
	document.getElementById('sort_div').innerHTML = show_cmt + '\n';
}
<?php

	if ($page_title == 'yes') {
		$js_title = "'+pagetitle+'";
		$js_title = (isset($_GET['pagetitle'])) ? ' on "' . $_GET['pagetitle'] . '"' : $js_title;
	} else {
		$js_title = '';
	}

	echo '// Place "hashover" DIV' . PHP_EOL;
	echo 'if (document.getElementById("hashover") == null) {' . PHP_EOL;
	echo "\t" . 'document.write("<div id=\"hashover\"></div>\n");' . PHP_EOL;
	echo '}' . PHP_EOL . PHP_EOL;

	// Changed order of appearence from this point to next indication (#showingcomments)

	if (!empty($show_cmt)) {
		echo 'var comments = [' . PHP_EOL;
		echo $show_cmt;
		echo '];' . PHP_EOL . PHP_EOL;
	}

	// Display comment count
	echo jsAddSlashes('<br><b class="cmtfont">');
	if ($cmt_count == "1") {
		echo jsAddSlashes($text['zero_cmt']);
	} else {
		echo jsAddSlashes($text['showing_cmts'] . ' ' . display_count() .':');
	}
	echo jsAddSlashes('</b>\n') . PHP_EOL;

	// Display comments in case there is anyone
	if (!empty($show_cmt)) {
		echo jsAddSlashes('<span style="float: right;">\n' . $text['sort'] . ': <select name="sort" size="1" onChange="sort_comments(this.value); return false;">\n');
		echo jsAddSlashes('<option value="ascending">' . $text['sort_ascend'] . '</option>\n');
		echo jsAddSlashes('<option value="descending">' . $text['sort_descend'] . '</option>\n');
		echo jsAddSlashes('<option value="byname">' . $text['sort_byname'] . '</option>\n');
		echo jsAddSlashes('<option value="bydate">' . $text['sort_bydate'] . '</option>\n');
		echo jsAddSlashes('</select>\n</span>\n') . PHP_EOL;

		echo jsAddSlashes('<div id="sort_div">\n'). PHP_EOL;
		echo 'for (var comment in comments) {' . PHP_EOL;
		echo "\t" . 'parse_template(comments[comment], false);' . PHP_EOL;
		echo '}' . PHP_EOL . PHP_EOL;
		echo jsAddSlashes('</div>\n') . PHP_EOL;
	}

	echo jsAddSlashes('</div><br>\n') . PHP_EOL;
	// Changed order of appearence from last indication (#showingcomments)

	// Changed order of appearence from this point to next indication (#showingform)
	echo jsAddSlashes('<a name="comments"></a><br><b class="cmtfont">' . $text['post_cmt'] . $js_title . ':</b>');

	if (isset($_COOKIE['message']) and !empty($_COOKIE['message'])) {
		echo jsAddSlashes('<b id="message" class="cmtfont">' . $_COOKIE['message'] . '</b><br><br>\n');
	} else {
		echo jsAddSlashes('<br><br>\n');
	}

	echo jsAddSlashes('<form id="comment_form" name="comment_form" action="' . $root_dir . 'comments.php" method="post">\n');

	if ($icons == 'yes') {
		echo jsAddSlashes('<span class="cmtnumber">' . $avatar_image . '</span>\n');
	} else {
		echo jsAddSlashes('<span class="cmtnumber"><a rel="nofollow" href="#comments">#' . $total_count . '</a></span>\n');
	}

	echo jsAddSlashes('<div class="cmtbox">\n');

	// Display name input tag if told to
	echo "if (name_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<input type="text" name="name" title="' . $text['nickname_tip'] . '"' . (isset($_COOKIE['name']) ? ' value="' . $_COOKIE['name'] . '"' : '') . ' maxlength="30" class="form-data opt-name" placeholder="' . $text['nickname'] . '">\n');
	echo "}\n\n";

	// Display email input tag if told to
	echo "if (email_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<input type="text" name="email" title="' . $text['email'] . '"' . (isset($_COOKIE['email']) ? ' value="' . $_COOKIE['email'] . '"' : '') . ' class="form-data opt-email" placeholder="' . $text['email'] . '">\n');
	echo "}\n\n";

	// Display website input tag if told to
	echo "if (sites_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<input type="text" name="website" title="' . $text['website'] . '"' . (isset($_COOKIE['website']) ? ' value="' . $_COOKIE['website'] . '"' : '') . ' class="form-data opt-website" placeholder="' . $text['website'] . '">\n');
	echo "}\n\n";

	echo jsAddSlashes('<div id="requiredFields" style="display: none;">\n');
	echo jsAddSlashes('<input type="text" name="summary" value="" placeholder="Summary">\n');
	echo jsAddSlashes('<input type="hidden" name="middlename" value="" placeholder="Middle Name">\n');
	echo jsAddSlashes('<input type="text" name="lastname" value="" placeholder="Last Name">\n');
	echo jsAddSlashes('<input type="text" name="address" value="" placeholder="Address">\n');
	echo jsAddSlashes('<input type="hidden" name="zip" value="" placeholder="Last Name">\n');
	echo jsAddSlashes('</div>\n') . PHP_EOL;

	$rows = "'+rows+'";
	$replyborder = (isset($_COOKIE['success']) and $_COOKIE['success'] == "no") ? ' border: 2px solid #FF0000 !important; -moz-border-radius: 5px 5px 0px 0px; border-radius: 5px 5px 0px 0px;' : '';

	echo jsAddSlashes('<textarea rows="' . $rows . '" cols="63" name="comment" placeholder="' . $text['comment_form'] . '" style="width: 100%;' . $replyborder . '" title="' . $text['cmt_tip'] . '"></textarea><br>\n');
    echo jsAddSlashes('<span class="button_area"><input class="post_cmt" type="submit" value="' . $text['post_button'] . '" onClick="return noemail();" onsubmit="return noemail();"></span><br>\n');
	echo (isset($_GET['canon_url']) or isset($canon_url)) ? jsAddSlashes('<input type="hidden" name="canon_url" value="' . $page_url . '">\n') : '';
	echo (isset($_COOKIE['replied'])) ? jsAddSlashes('<input type="hidden" name="reply_to" value="' . $_COOKIE['replied'] . '">\n') : '';
	echo jsAddSlashes('</div>\n</form>\n'). PHP_EOL;

	// Changed order of appearence from last indication (#showingform)

	// To reverse to original order switch previous indicated blocks with #showingcomments and #showingform

	echo jsAddSlashes('<p style="font-size: 0.8em; text-align: center;">Comentaris fets amb <a rel="nofollow" href="https://github.com/mnguerra/hashover-md">HashOver-md</a>.</p>\n');

	// Script execution ending time
	$exec_time = explode(' ', microtime());
	$exec_end = $exec_time[1] + $exec_time[0];
	$exec_time = ($exec_end - $exec_start);

	echo PHP_EOL . '// Place all content on page' . PHP_EOL;
	echo 'document.getElementById("hashover").innerHTML = show_cmt;' . PHP_EOL . PHP_EOL;
	echo '// Script Execution Time: ' . round($exec_time, 5) . ' Seconds';

?>
