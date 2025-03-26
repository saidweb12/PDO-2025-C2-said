<?php
# À enregistrer sous le nom config-prod.php

// pour MySQL
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3306;
const DB_CONNECT_NAME = "pdo_exe_c2";
const DB_CONNECT_CHARSET = "utf8";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";

// pages acceptées dans le menu
const PAGE_MENU = ["query-fetchall","exec","prepare-bindParam"];