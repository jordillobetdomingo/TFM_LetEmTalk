<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository;

use phpDocumentor\Reflection\Types\Mixed_;
use Predis\Client;

abstract class RedisRepository
{
    private Client $redis;


    public function __construct()
    {
        $this->redis = new Client(
            [
                'scheme' => 'tcp',
                'host' => 'redis',
                'port' => 6379
            ]
        );
    }

    protected function get(RedisKey $key)
    {
        return unserialize($this->redis->get($key->getKey()));
    }

    protected function getList(RedisKey $key): array
    {
        $values = $this->redis->lrange($key->getKey(), 0, $this->redis->llen($key->getKey()));
        return array_map(function ($value) {
            return unserialize($value);
        }, $values);
    }

    protected function set(RedisKey $key, $value): void
    {
        $this->redis->set($key->getKey(), serialize($value));
    }

    protected function setList(RedisKey $key, array $values): void
    {
        $this->redis->lpush($key->getKey(), array_map(function($value) {
            return serialize($value);
        },$values));
    }

    protected function addElemList(RedisKey $key, $value): void
    {
        $this->redis->lpush($key, [$value]);
    }

    protected function del(RedisKey $key): void
    {
        $this->redis->del([$key->getKey()]);
    }

    protected function exists(RedisKey $key): bool
    {
        return $this->redis->exists($key->getKey());
    }
}