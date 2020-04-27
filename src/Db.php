<?php


class Db
{
    private PDO $driver;

    public function __construct()
    {
        $driver = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
        $driver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->driver = $driver;
    }

    public function query($sql)
    {
        return $this->driver->query($sql, PDO::FETCH_ASSOC);
    }

    public function trim($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
        }

        return $data;
    }
}