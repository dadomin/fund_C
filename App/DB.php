<?php

namespace Damin;

class DB {
	public static $con = null;

	public static function getDB()
	{
		if(self::$con == null){
			self::$con = new \PDO("mysql:host=localhost; dbname=fund; charset=utf8", "root", "");
		}

		return self::$con;
	}

	public static function fetchAll($sql, $param = [])
	{
		$con = self::getDB();
		$q = $con->prepare($sql);
		$q = $q->execute($param);
		return $q->fetchAll(\PDO::FETCH_OBJ);
	}

	public static function fetch($sql, $param = [])
	{
		$con = self::getDB();
		$q = $con->prepare($sql);
		$q = $q->execute($param);
		return $q->fetch(\PDO::FETCH_OBJ);
	}

	public static function query($sql, $param = [])
	{
		$con = self::getDB();
		$q = $con->prepare($sql);
		return $q->execute($param);
	}

	public static function msgAndGo($msg, $link)
	{
		echo "<script>";
		echo "alert('$msg');";
		echo "location.href = '$link';";
		echo "</script>";
	}

	public static function msgAndBack($msg)
	{
		echo "<script>";
		echo "alert('$msg');";
		echo "history.back();";
		echo "</script>";
	}
}