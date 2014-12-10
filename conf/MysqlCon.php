<?php
/**
 * Created by JetBrains PhpStorm.
 * User: 刘齐均
 * Date: 14-10-11
 * Time: 上午3:14
 * To change this template use File | Settings | File Templates.
 */

class MysqlCon {
    private $host = "localhost";
    private $mysqlusername = "root";
    private $mysqlpasswd = "1234";
    private $mysqldb = "sjdxs";
    protected function connectToMysql()
    {
        $con = mysqli_connect($this->host, $this->mysqlusername, $this->mysqlpasswd);
        mysqli_select_db($con, $this->mysqldb);
        return $con;
    }
    protected function closeMysql($con)
    {
        mysqli_close($con);
    }
}