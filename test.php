<?php
var_dump($_FILES);
var_dump(file_get_contents($_FILES['file']['tmp_name']));
var_dump(file_get_contents($_FILES['file']['tmp_name']));
