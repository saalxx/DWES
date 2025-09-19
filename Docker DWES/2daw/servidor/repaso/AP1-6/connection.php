<?php
class connection{
    private const host = 'mariadb-server';
    private const username = 'root';
    private const password = 'root';
    private const database = 'AP1';
    protected $mysqli;

    public function __construct(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    }
}
