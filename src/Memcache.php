<?php
/**
 * @CreateTime:   2021/1/20 11:53 下午
 * @Author:       huizhang  <2788828128@qq.com>
 * @Copyright:    copyright(2020) Easyswoole all rights reserved
 * @Description:  mcq客户端
 */

namespace Huizhang\Memcache;

use Huizhang\Memcache\CommandHandler\Add;
use Huizhang\Memcache\CommandHandler\Append;
use Huizhang\Memcache\CommandHandler\Cas;
use Huizhang\Memcache\CommandHandler\Delete;
use Huizhang\Memcache\CommandHandler\Get;
use Huizhang\Memcache\CommandHandler\Gets;
use Huizhang\Memcache\CommandHandler\Prepend;
use Huizhang\Memcache\CommandHandler\Replace;
use Huizhang\Memcache\CommandHandler\Set;

class Memcache
{

    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function set(string $key, string $value, int $exptime = 0)
    {
        $command = new Set($this->config);
        return $command->handler($key, $value, $exptime);
    }

    public function add(string $key, string $value, int $exptime = 0)
    {
        $command = new Add($this->config);
        return $command->handler($key, $value, $exptime);
    }

    public function replace(string $key, string $value, int $exptime = 0)
    {
        $command = new Replace($this->config);
        return $command->handler($key, $value, $exptime);
    }

    public function append(string $key, string $value, int $exptime = 0)
    {
        $command = new Append($this->config);
        return $command->handler($key, $value, $exptime);
    }

    public function prepend(string $key, string $value, int $exptime = 0)
    {
        $command = new Prepend($this->config);
        return $command->handler($key, $value, $exptime);
    }

    public function cas(string $key, string $value, int $token, int $exptime = 0)
    {
        $command = new Cas($this->config);
        return $command->handler($key, $value, $token, $exptime);
    }

    public function get(string ...$keys)
    {
        $command = new Get($this->config);
        return $command->handler(...$keys);
    }

    public function gets(string ...$keys)
    {
        $command = new Gets($this->config);
        return $command->handler(...$keys);
    }

    public function delete(string $key)
    {
        $command = new Delete($this->config);
        return $command->handler($key);
    }

    public function incr()
    {

    }

    public function decr()
    {

    }

    public function stats()
    {

    }

    public function statsItems()
    {

    }

    public function statsSlabs()
    {

    }

    public function statsSizes()
    {

    }

    public function flushAll()
    {

    }

}


