<?php
# À enregistrer sous le nom config.php
# fichier de configuration de PDO en mode développement
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3306;
const DB_CONNECT_NAME = "pdo_c2_exe_ti2";
const DB_CONNECT_CHARSET = "utf8";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";

const DB_DSN = DB_CONNECT_TYPE . ":host=" . DB_CONNECT_HOST . ";port=" . DB_CONNECT_PORT . ";dbname=" . DB_CONNECT_NAME . ";charset=" . DB_CONNECT_CHARSET;