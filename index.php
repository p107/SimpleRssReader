<?php
/**
 * Simple RSS Reader
 *
 */

include "conf/settings.php";
include "tools/tools.php";

include "dao/RssReader.class.php";
include "controller/Controller.class.php";
include "controller/XLab.class.php";

$xlab = new XLab();
$xlab->render();

