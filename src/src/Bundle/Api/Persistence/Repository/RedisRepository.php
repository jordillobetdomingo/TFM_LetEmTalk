<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository;

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

    abstract protected function getKey(int $id): string;

    protected function get(int $id)
    {
        return unserialize($this->redis->get($this->getKey($id)));
    }

    protected function set(int $id, $value): void
    {
        $this->redis->set($this->getKey($id), serialize($value));
    }

    protected function del(int $id): void
    {
        $this->redis->del([$this->getKey($id)]);
    }

    protected function exists(int $id): bool
    {
        return $this->redis->exists($this->getKey($id));
    }
}