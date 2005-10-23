<?php
//error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);

$pages = array(
    /* pagename	    => array(english, italian) */
    "Home"	    => array("home", ""),
    "About"	    => array("README", ""),
    "Documentation" => array("netsukuku",
			     "netsukuku.ita"),	
    "FAQ"	    => array("doc/FAQ", ""),
    "Download"	    => array("http://netsukuku.freaknet.org/files", ""),
    "Contacts"	    => array("contacts", ""),
);

/* default page = home */
if(isset($_GET['p']) && isset($pages[$_GET['p']]))
    $page = $_GET['p'];
else
    $page = "Home";

/* default language = english */
if(isset($_POST['lang']) && $_POST['lang'] == "it")
	$lang = "it";
else
	$lang = "en";


$navbar = "";
foreach($pages as $pname => $pdata) {
    $pclass = ($pname == $page) ? "iam" : "menu";
    $navbar .= "<td>&nbsp;&nbsp;&nbsp;</td>".
	"<td><a href=\"?p=$pname\" class=\"$pclass\">$pname</a></td>";
}

$it_selected = $en_selected = "";
if($lang == "it" && strlen($pages[$page][1])) {
    $to_include = $pages[$page][1];
    $it_selected = "selected=\"yes\"";
} else {
    $to_include = $pages[$page][0];
    $en_selected = "selected=\"yes\"";
}

$content = file_get_contents($to_include);
if(! ereg("^http:", $to_include)) {
	$content = htmlentities($content);
   	$content = preg_replace("/(http:\/\/[^\s\)]*)/", "<a href=\"\\1\">\\1</a>", $content);
   
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Netsukuku</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css" />

<body bgcolor="#000000" topmargin="1" leftmargin="1" text="white">
	<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="logo_netsukuku.jpg" /></td>
	</tr>
	<tr>
		<td>
		<table cellpadding="0" border="0" cellspacing="0" class="puppu">
		<tr>
		<?php echo $navbar;?>
		</tr>
		</table>
		</td>
	</tr>
	<?php
	if($page == "Documentation") {
	?>
	<tr>
	<td>
		<br />
		<table>
		<tr><td class="manpage">
		<b>Man Pages</b><br />
		<a href="http://netsukuku.freaknet.org/doc/man_html/andna.html">andna</a><br />
		<a href="http://netsukuku.freaknet.org/doc/man_html/netsukuku_d.html">netsukuku_d</a><br />
		<a href="http://netsukuku.freaknet.org/doc/man_html/netsukuku_wifi.html">netsukuku_wifi</a><br />
		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td>
		<form action="" method="post">
		<select name="lang" size="1" onchange="this.form.submit();">
		<option value="en" <?php echo $en_selected; ?>>English</option>
		<option value="it" <?php echo $it_selected; ?>>Italiano</option>
		</select>
		</form>
		</td>
		</tr>
		</table>
	
	</td>
	</tr>
	<?php } ?>

	<tr>
		<td>
		<pre>
		<?php echo $content; ?>
		</pre>
		</td>
		</tr>
	</table>
	<font color="#9A9A9A">
	<pre>
	--
	design by <a href="mailto:crash@freaknet.org">crash</a> && <a href="mailto:black@autistici.org">black</a> && <a href="mailto:e@entropika.net">entropika</a>
	</pre>
	</font>
</body>
</html>