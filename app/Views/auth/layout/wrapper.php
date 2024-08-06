<?php 
require_once('header.php');
if (isset($content)) {
    echo view($content);
}
require_once('footer.php');
