<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository;

use Predis\Client;

abstract class RedisRepository
{
    const ENV_REDIS_CONFIG_SCHEME = "REDIS_SCHEME";
    const ENV_REDIS_CONFIG_HOST = "REDIS_HOST";
    const ENV_REDIS_CONFIG_PORT = "REDIS_PORT";

    private Client $redis;

    public function __construct()
    {
        $this->redis = new Client(
            [
                'scheme' => $_ENV[self::ENV_REDIS_CONFIG_SCHEME],
                'host' => $_ENV[self::ENV_REDIS_CONFIG_HOST],
                'port' => $_ENV[self::ENV_REDIS_CONFIG_PORT]
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

    protected function del(RedisKey $key): void
    {
        $this->redis->del([$key->getKey()]);
    }

    protected function exists(RedisKey $key): bool
    {
        return $this->redis->exists($key->getKey());
    }
}