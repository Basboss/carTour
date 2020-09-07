<?php

namespace Game\Entity;

use PDO;

abstract class Entity {
    const DSN = "mysql:host=localhost;dbname=cartour";
    const USER = "root";
    const PASSWORD = "";
    private static $db;

    private $id;

    private static function connect()
    {
        self::$db = new PDO(self::DSN, self::USER, self::PASSWORD);
    }

    public static function getOneRandom()
    {
        if(empty(self::$db)) {
            self::connect();
        }
        $table = self::findTable();
        $stmt = self::$db->prepare('SELECT * FROM ' . $table . ' ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $class = get_called_class();
        return new $class($data);
    }

    private static function findTable()
    {
        $class = get_called_class();
        $strings = explode( '\\', $class );
        return strtolower( end( $strings ) );
    }

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        foreach($data as $key => $value) {
            $setter = "set" . ucfirst($key);
            
            if(method_exists($this, $setter)){
                $this->$setter($value);
            }
        }
    }

    public function getId(): int
    {
        return $this->id;
    }   

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }
}