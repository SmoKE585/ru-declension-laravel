<?php

namespace SmoKE585\RUDeclensionLaravel\Services\Dictionary;

use PDO;
use PDOException;
use PDOStatement;

class SqliteDictionary implements DictionaryInterface
{
    protected static array $cache = [];

    protected ?PDO $pdo = null;
    protected ?PDOStatement $stmt = null;
    protected bool $isUnavailable = false;

    public function __construct(
        protected string $path
    ) {}

    public function get(string $word): ?array
    {
        if ($this->isUnavailable || $word === '') {
            return null;
        }

        $key = $this->path . '|' . $word;

        if (array_key_exists($key, self::$cache)) {
            return self::$cache[$key];
        }

        $pdo = $this->getConnection();
        if (!$pdo) {
            $this->isUnavailable = true;
            return null;
        }

        $stmt = $this->stmt ??= $pdo->prepare('SELECT one, few, many FROM forms WHERE lemma = :lemma LIMIT 1');
        $stmt->execute(['lemma' => $word]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            self::$cache[$key] = null;
            return null;
        }

        self::$cache[$key] = $row;

        return $row;
    }

    protected function getConnection(): ?PDO
    {
        if ($this->pdo) {
            return $this->pdo;
        }

        if (!is_file($this->path)) {
            return null;
        }

        try {
            $this->pdo = new PDO('sqlite:' . $this->path);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException) {
            return null;
        }

        return $this->pdo;
    }
}
