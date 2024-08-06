<?php 
require_once('header.php');
require_once('sidebar-dashboard.php');
if (isset($content)) {
    echo view($content);
}
require_once('footer.php');
