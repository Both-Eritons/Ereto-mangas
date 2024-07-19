<?php

use Ereto\Api\Models\MangaModel;
use Ereto\Api\Repositories\MangaRepository as MR;
use Ereto\Api\Services\MangaService as MS;
use Ereto\Constants\MangaConstant as MC;
use Exception;
use PHPUnit\Framework\TestCase;

class CreateMangaTest extends TestCase {

  private $mangaMock, $mangaS;
  function setUp(): void
  {
    $this->mangaMock = $this->createMock(MR::class);
    $this->mangaS = new MS($this->mangaMock);
  }

  function testMangaExists() {
    $this->mangaMock->method("findMangaByTitle")
      ->willReturn(MangaModel::class);
    $this->expectException(Exception::class);
    $this->expectExceptionMessage(MC::$msg["READ"]);
    $this->expectExceptionCode(409);
    $this->mangaS->createManga("berserk");
  }
}
