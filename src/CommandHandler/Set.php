<?php

namespace Huizhang\Memcache\CommandHandler;

use Huizhang\Memcache\Core\ClientResponse;
use Huizhang\Memcache\Core\MemcacheResponse;

class Set extends CommandHandlerAbstract
{

    protected $commandName = 'set';

    public function handler(...$data): MemcacheResponse
    {
        [$key, $value, $expire] = $data;
        $command = sprintf(
            "%s %s 0 %s %s \r\n"
            , $this->commandName
            , $key
            , $expire
            , strlen($value)
        );
        $client = $this->getClient();
        $response = new MemcacheResponse(MemcacheResponse::STATUS_FAILED);
        if ($client->sendCommand($command)) {
            $command = sprintf("%s\r\n", $value);
            if ($client->sendCommand($command)) {
                $result = $client->recv();
                if ($result->getStatus() === ClientResponse::STATUS_OK) {
                    if ($result->getData() === 'STORED') {
                        $response->setStatus(MemcacheResponse::STATUS_SUCCESS);
                    } else {
                        $response->setErrMsg($result->getData());
                    }
                } else {
                    $response->setErrMsg($result->getMsg());
                }
            } else {
                $response->setErrMsg($command);
            }
        } else {
            $response->setErrMsg($command);
        }
        return $response;
    }

}
