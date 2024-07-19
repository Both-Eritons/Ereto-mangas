<?php

namespace Ereto\Tests;

use Ereto\Api\Repositories\MangaRepository as MR;
use Ereto\Api\Services\MangaService as MS;
use Ereto\Constants\MangaConstant as MC;
use Exception;
use PHPUnit\Framework\TestCase;

class SearchMangaTest extends TestCase {

  private $mangaMock, $mangaS;
  function setUp(): void
  {
    $this->mangaMock = $this->createMock(MR::class);
    $this->mangaS = new MS($this->mangaMock);
  }

  function testTitleIsNull(){
    $this->expectException(Exception::class);
    $this->expectExceptionMessage(MC::$errors["NOT_FOUND"]);
    $this->expectExceptionCode(404);
    $this->mangaS->searchManga(null);
  }
  
  function testResultIsNull(){
    $this->mangaMock->method("searchManga")
                    ->willReturn(null);
    $this->expectException(Exception::class);
    $this->expectExceptionMessage(MC::$errors["NOT_FOUND"]);
    $this->expectExceptionCode(404);
    $this->mangaS->searchManga("abc");
  }

  function testMangaSearchSuccessAndReturnArray() {
    $this->mangaMock->method("searchManga")
                    ->willReturn([]);
    $re = $this->mangaS->searchManga("ber");
    $this->assertIsArray($re);
  } 
}
