<?php

namespace Tasksuki\Component\JsonSerializer\Test;

use PHPUnit\Framework\TestCase;
use Tasksuki\Component\JsonSerializer\JsonSerializer;
use Tasksuki\Component\Message\Message;

/**
 * Class JsonSerializerTest
 *
 * @package Tasksuki\Component\JsonSerializer\Test
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class JsonSerializerTest extends TestCase
{
    public function testSerialize()
    {
        $message = new Message();
        $message
            ->setData(['foo' => 'bar'])
            ->setName('foo_bar');

        $expected = [
            'data' => ['foo' => 'bar'],
            'name' => 'foo_bar'
        ];

        $serializer = new JsonSerializer();

        $this->assertJsonStringEqualsJsonString($serializer->serialize($message), json_encode($expected));
    }

    public function testUnserialize()
    {
        $expected = new Message();
        $expected
            ->setData(['foo' => 'bar'])
            ->setName('foo_bar');

        $given = [
            'data' => ['foo' => 'bar'],
            'name' => 'foo_bar'
        ];

        $serializer = new JsonSerializer();

        $this->assertEquals($expected, $serializer->unserialize(json_encode($given)));
    }

    /**
     * @expectedException Tasksuki\Component\Serializer\Exception\NotValidInputException
     * @expectedExceptionMessage Syntax error
     */
    public function testUnserializeFail()
    {
        $input = '$$';

        $serializer = new JsonSerializer();

        $this->setExpectedExceptionFromAnnotation();

        $serializer->unserialize($input);
    }
}
