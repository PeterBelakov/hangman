<?php
#Load all Drivers, DTO, Models in a fancy way :)
ini_set("include_path", "./Drivers");
ini_set("include_path", "./DTO");
ini_set("include_path", "./Models");
spl_autoload_register();
