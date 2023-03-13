<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Src\Core\Request\HttpHandler;
use Src\Core\Parser\Parser;
use Src\Core\Request\ResponseDTO;

final class ParserTest extends TestCase
{
    public function testParser(): void
    {
        $data = [
            'body' => '<div><div>2<p>3</p><p>3</p><p>3</p></div></div>',
            'status' => 200,
            'content_type' => 'text/html',
        ];

        $dto = new ResponseDTO();
        $dto->setData($data);

        $http = new HttpHandler(dto: $dto);
        $content = $http->getContent();

        $this->assertSame($data['body'], $content);

        $parser = new Parser($content);
        $tags = $parser->findTags();

        $this->assertArrayHasKey('div', $tags);
        $this->assertSame(2, $tags['div']);

        $this->assertArrayHasKey('p', $tags);
        $this->assertSame(3, $tags['p']);
    }
}
