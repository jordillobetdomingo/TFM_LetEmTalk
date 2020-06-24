<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository;



class RedisKey
{
    const CHAR_KEY = ":";

    private array $keys;
    private array $values;

    public function __construct(array $keys, array $values)
    {
        if (count($keys) != count($values)) {
            throw new \InvalidArgumentException();
        }
        $this->keys = $keys;
        $this->values = $values;
    }

    public function getKey(): string
    {
        $key = "";
        for($i = 0; $i < count($this->keys); $i++) {
            if ($i == 0) {
                $key .= $this->keys[$i] . self::CHAR_KEY . $this->values[$i];
            } else {
                $key .= self::CHAR_KEY . $this->keys[$i] . self::CHAR_KEY . $this->values[$i];
            }
        }
        return $key;
    }
}