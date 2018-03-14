<?php

namespace components;


abstract class Model
{
    /**
     * @var null|string
     */
    protected $primaryKey = null;

    /**
     * @var null|string
     */
    protected $table = null;

    /**
     * @var array
     */
    protected $attributes = [];

    public function __set($name, $value)
    {
        if (isset($this->{$name})) {
            $this->attributes[$name] = $value;
        } else {
            throw new \Exception("Property '{$name}' in undefined");
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * @return \PDO
     */
    public function getDbConnect()
    {
        return Application::get('db')->getConnection();
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    public function load(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @param $id
     * @return $this
     */
    protected function find($id)
    {
        $stmt = $this->getDbConnect()->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->execute([$id]);

        $this->load($stmt->fetch(\PDO::FETCH_ASSOC));
        return $this;
    }

    /**
     * @return bool
     */
    public function save()
    {
        if (empty($this->{$this->primaryKey})) {
            return $this->create();
        } else {
            return $this->update();
        }
    }

    /**
     * @return bool
     */
    protected function create()
    {
        $columns = [];
        $aliases = [];
        $values = [];
        foreach ($this->attributes as $key => $value) {
            if ($key == $this->primaryKey) {
                continue;
            }

            $columns[] = $key;
            if (in_array($key, ['created_at', 'updated_at'])) {
                $aliases[] = 'now()';
            } else {
                $aliases[] = ":{$key}";
                $values[":{$key}"] = $value;
            }
        }

        $columnsString = implode(', ', $columns);
        $aliasesString = implode(', ', $aliases);
        $stmt = $this->getDbConnect()->prepare("INSERT INTO {$this->table} ($columnsString) VALUES ($aliasesString)");

        foreach ($values as $alias => $data) {
            $stmt->bindParam($alias, $data);
        }

        $isCorrect = $stmt->execute();
        if ($isCorrect) {
            $this->find($this->getDbConnect()->lastInsertId());
        }

        return $isCorrect;
    }

    /**
     * @return bool
     */
    protected function update()
    {

    }
}