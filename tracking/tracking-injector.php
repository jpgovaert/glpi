<?php
/*
 
 ----------------------------------------------------------------------
GLPI - Gestionnaire libre de parc informatique
 Copyright (C) 2002 by the INDEPNET Development Team.
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------
 Based on:
IRMA, Information Resource-Management and Administration
Christian Bauer, turin@incubus.de 

 ----------------------------------------------------------------------
 LICENSE

This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ----------------------------------------------------------------------
 Original Author of file:
 Purpose of file:
 ----------------------------------------------------------------------


*/

include ("_relpos.php");
include ($phproot . "/glpi/includes.php");
include ($phproot . "/glpi/includes_tracking.php");
include ($phproot . "/glpi/includes_setup.php");

checkAuthentication("post-only");

$glpiname = $_SESSION["glpiname"];

if (!$glpiname || $glpiname == "bogus")
{
	
	$glpiname = "Helpdesk";
}

loadLanguage($glpiname);

$status = "new";

$ID=$_POST["computer"];

if ($_POST["priority"] && !$_POST["contents"])
{
	nullHeader("Tracking",$_SERVER["PHP_SELF"]);
	echo "<center><img src=\"".$cfg_install["root"]."/pics/warning.png\" alt=\"warning\"><br><br><b>";
	echo $lang["help"][15]."<br><br>";
	echo "<a href=\"javascript:history.back()\">...back</a>";
	echo "</b></center>";
	nullFooter();
	exit;
}
elseif ($_POST["emailupdates"] == "yes" && $_POST["uemail"]=="")
{
	nullHeader("Tracking",$_SERVER["PHP_SELF"]);
		echo "<center><img src=\"".$cfg_install["root"]."/pics/warning.png\" alt=\"warning\"><br><br><b>";

	echo $lang["help"][16]."<br><br>";
	echo "<a href=\"javascript:history.back()\">...back</a>";
	echo "</b></center>";
	nullFooter();
	exit;
}
elseif (empty($ID))
{
	nullHeader("Tracking",$_SERVER["PHP_SELF"]);
		echo "<center><img src=\"".$cfg_install["root"]."/pics/warning.png\" alt=\"warning\"><br><br><b>";

	echo $lang["help"][17]."<br><br>";
	echo "<a href=\"javascript:history.back()\">...back</a>";
	echo "</b></center>";
	nullFooter();
	exit;
} 
else
{
	if (postJob($ID,$glpiname,$status,$_POST["priority"],$_POST["computer"],$_POST["isgroup"],$_POST["uemail"],$_POST["emailupdates"],$_POST["contents"]))
	{
		nullHeader("Tracking",$_SERVER["PHP_SELF"]);
		echo "<center><img src=\"".$cfg_install["root"]."/pics/ok.png\" alt=\"OK\"><br><br><b>";
		echo $lang["help"][18]."<br>";
		echo $lang["help"][19];
		echo "</b></center>";
		nullFooter();
	
	}
	else
	{
		nullHeader("Tracking",$_SERVER["PHP_SELF"]);
			echo "<center><img src=\"".$cfg_install["root"]."/pics/warning.png\" alt=\"warning\"><br><br><b>";

		echo $lang["help"][20]."<br>";
		echo $lang["help"][21];
		echo "</b></center>";
		nullFooter();
	}
}

?>
