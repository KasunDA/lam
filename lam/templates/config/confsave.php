<?php
/*
$Id$

  This code is part of LDAP Account Manager (http://www.sourceforge.net/projects/lam)
  Copyright (C) 2003  Roland Gruber

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


  confsave saves the new preferences to lam.conf

*/
include_once ('../../lib/config.inc');

// start session
session_save_path("../../sess");
@session_start();

setlanguage();

$conf = new Config($_SESSION['filename']);

// get data from session
if ($_SESSION['passwd']) $passwd = $_SESSION['passwd'];
if ($_SESSION['passwd1']) $passwd1 = $_SESSION['passwd1'];
if ($_SESSION['passwd2']) $passwd2 = $_SESSION['passwd2'];
if ($_SESSION['serverurl']) $serverurl = $_SESSION['serverurl'];
if ($_SESSION['admins']) $admins = $_SESSION['admins'];
if ($_SESSION['suffusers']) $suffusers = $_SESSION['suffusers'];
if ($_SESSION['suffgroups']) $suffgroups = $_SESSION['suffgroups'];
if ($_SESSION['suffhosts']) $suffhosts = $_SESSION['suffhosts'];
if ($_SESSION['minUID']) $minUID = $_SESSION['minUID'];
if ($_SESSION['maxUID']) $maxUID = $_SESSION['maxUID'];
if ($_SESSION['minGID']) $minGID = $_SESSION['minGID'];
if ($_SESSION['maxGID']) $maxGID = $_SESSION['maxGID'];
if ($_SESSION['minMach']) $minMach = $_SESSION['minMach'];
if ($_SESSION['maxMach']) $maxMach = $_SESSION['maxMach'];
if ($_SESSION['usrlstattr']) $usrlstattr = $_SESSION['usrlstattr'];
if ($_SESSION['grplstattr']) $grplstattr = $_SESSION['grplstattr'];
if ($_SESSION['hstlstattr']) $hstlstattr = $_SESSION['hstlstattr'];
if ($_SESSION['maxlistentries']) $maxlistentries = $_SESSION['maxlistentries'];
if ($_SESSION['lang']) $lang = $_SESSION['lang'];
if ($_SESSION['scriptpath']) $scriptpath = $_SESSION['scriptpath'];
if ($_SESSION['scriptserver']) $scriptserver = $_SESSION['scriptserver'];
if ($_SESSION['samba3']) $samba3 = $_SESSION['samba3'];
if ($_SESSION['domainSID']) $domainSID = $_SESSION['domainSID'];
if ($_SESSION['filename']) $filename = $_SESSION['filename'];

// check if password is correct
// if not: load login page
if ($passwd != $conf->get_Passwd()) {
	require('conflogin.php');
	exit;
}

echo ("<?xml version=\"1.0\" encoding=\"ISO-8859-15\"?>\n");
echo ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n");

echo "<html><head><title>listusers</title>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../../style/layout.css\">\n";
echo "</head><body>\n";

echo ("<p align=\"center\"><a href=\"http://lam.sf.net\" target=\"new_window\">".
	"<img src=\"../../graphics/banner.jpg\" border=1 alt=\"LDAP Account Manager\"></a></p><hr><br><br>");

// check new preferences
if (!$serverurl) {
	echo ("<font color=\"red\"><b>" . _("Server Address is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$admins) {
	echo ("<font color=\"red\"><b>" . _("List of admin users is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$suffusers) {
	echo ("<font color=\"red\"><b>" . _("UserSuffix is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$suffgroups) {
	echo ("<font color=\"red\"><b>" . _("UserSuffix is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$suffhosts) {
	echo ("<font color=\"red\"><b>" . _("HostSuffix is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$minUID) {
	echo ("<font color=\"red\"><b>" . _("MinUID is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$maxUID) {
	echo ("<font color=\"red\"><b>" . _("MaxUID is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$minGID) {
	echo ("<font color=\"red\"><b>" . _("MinGID is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$maxGID) {
	echo ("<font color=\"red\"><b>" . _("MaxGID is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$minMach) {
	echo ("<font color=\"red\"><b>" . _("MinMachine is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$maxMach) {
	echo ("<font color=\"red\"><b>" . _("MaxMachine is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$usrlstattr) {
	echo ("<font color=\"red\"><b>" . _("No attributes in user list!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$grplstattr) {
	echo ("<font color=\"red\"><b>" . _("No attributes in group list!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$hstlstattr) {
	echo ("<font color=\"red\"><b>" . _("No attributes in host list!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}
if (!$maxlistentries) {
	echo ("<font color=\"red\"><b>" . _("Max list entries is empty!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}

if (!$lang) {
	echo ("<font color=\"red\"><b>" . _("Language is not defined!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}

if (!$samba3) {
	echo ("<font color=\"red\"><b>" . _("Samba version is not defined!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}

if (($samba3 == "yes") && (!$domainSID)) {
	echo ("<font color=\"red\"><b>" . _("Samba 3 needs a domain SID!") . "</b></font>");
	echo ("\n<br><br><br><a href=\"javascript:history.back()\">" . _("Back to preferences...") . "</a>");
	exit;
}

// set new preferences
$conf->set_ServerURL($serverurl);
$conf->set_Adminstring($admins);
$conf->set_UserSuffix($suffusers);
$conf->set_GroupSuffix($suffgroups);
$conf->set_HostSuffix($suffhosts);
$conf->set_minUID($minUID);
$conf->set_maxUID($maxUID);
$conf->set_minGID($minGID);
$conf->set_maxGID($maxGID);
$conf->set_minMachine($minMach);
$conf->set_maxMachine($maxMach);
$conf->set_userlistAttributes($usrlstattr);
$conf->set_grouplistAttributes($grplstattr);
$conf->set_hostlistAttributes($hstlstattr);
$conf->set_MaxListEntries($maxlistentries);
$conf->set_defaultLanguage($lang);
$conf->set_samba3($samba3);
$conf->set_domainSID($domainSID);
// optional
if ($_SESSION['scriptpath']) $conf->set_scriptpath($scriptpath);
else $conf->set_scriptpath("");
if ($_SESSION['scriptserver']) $conf->set_scriptserver($scriptserver);
else $conf->set_scriptserver("");



// check if password was changed
if ($pass1 != $pass2) {
	echo ("<b>" . _("Passwords are different!") . "</b>");
	exit;
}
// set new password
if ($pass1 != "") {
	$conf->set_Passwd($pass1);
	echo ("<b>" . _("Password changed!") . "</b><br><br>");
}
// save settings and display new settings
$conf->save();
echo ("<b>" . _("The following settings were saved to profile:") . " </b>" . $filename . "<br><br>");
$conf->printconf();
echo ("<br><br><br><br><br><a href=\"../login.php\" target=\"_top\">" . _("Back to Login") . "</a>");

echo("</body></html>");

// remove settings from session
session_unregister('passwd');
session_unregister('passwd1');
session_unregister('passwd2');
session_unregister('serverurl');
session_unregister('admins');
session_unregister('suffusers');
session_unregister('suffgroups');
session_unregister('suffhosts');
session_unregister('minUID');
session_unregister('maxUID');
session_unregister('minGID');
session_unregister('maxGID');
session_unregister('minMach');
session_unregister('maxMach');
session_unregister('usrlstattr');
session_unregister('grplstattr');
session_unregister('hstlstattr');
session_unregister('maxlistentries');
session_unregister('lang');
session_unregister('scriptpath');
session_unregister('scriptserver');
session_unregister('samba3');
session_unregister('domainSID');
session_unregister('filename');

?>
