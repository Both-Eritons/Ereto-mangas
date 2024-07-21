<?php

namespace Ereto\Tests;

use Ereto\Api\Models\MangaModel;
use Ereto\Api\Repositories\MangaRepository;
use Ereto\Api\Services\MangaService;
use Ereto\Constants\MangaConstant as MC;
use Exception;
use PHPUnit\Framework\TestCase;

class DeleteMangaTest extends TestCase {

  private $mangaMock, $mangaS;
  function setUp(): void
  {
    $this->mangaMock = $this->createMock(MangaRepository::class);
    $this->mangaS = new MangaService($this->mangaMock);
  }

  function testMangaNotExists() {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage(MC::$errors["NOT_FOUND"]);
    $this->expectExceptionCode(404);
    $this->mangaS->deleteMangaByTitle("berserk"); 
  }

  function testTitleIsNull() {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage(MC::$errors["BLANK_TITLE"]);
    $this->expectExceptionCode(400);

    $this->mangaS->deleteMangaByTitle(null); 
  }
  function testDeleteManga() {
    $manga = new MangaModel(1, "berserk", "logo.jpg", "tuku");
    //$this->mangaMock->method("createManga")->willReturn($manga);
    $c =$this->mangaMock->method("findMangaByTitle")->willReturn($manga);
    $this->expectException(Exception::class);
    $this->expectExceptionMessage(MC::$errors["DELETE"]);
    $this->expectExceptionCode(400);
    $re = $this->mangaS->deleteMangaByTitle($manga->getTitle()); 
    //$this->isInstanceOf($re::class, $manga::class);
  }

}
