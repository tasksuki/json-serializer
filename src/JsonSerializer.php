<?php

namespace Tasksuki\Component\JsonSerializer;

use Tasksuki\Component\Message\Message;
use Tasksuki\Component\Serializer\Exception\NotValidInputException;
use Tasksuki\Component\Serializer\Exception\SerializerException;
use Tasksuki\Component\Serializer\SerializerInterface;

/**
 * Class JsonSerializer
 *
 * @package Tasksuki\Component\JsonSerializer
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class JsonSerializer implements SerializerInterface
{
    /**
     * @param Message $message
     *
     * @return string
     */
    public function serialize(Message $message): string
    {
        return json_encode($message);
    }

    /**
     * @param string $data
     *
     * @return Message
     * @throws NotValidInputException
     */
    public function unserialize(string $data): Message
    {
        $data = json_decode($data, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new NotValidInputException(json_last_error_msg());
        }

        return Message::fromArray($data);
    }

}