<?php

namespace Ereto\FileManagements;


class MangaManagement {
  
  public function __construct(private $folder) {
    $this->folder = $folder;
  }
  
  function folderExists(): bool { 
    return dir($this->folder) ? true : false;
  }

  function createFolder(string $name) {
    $loc = $this->folder."/".$name;
    
    return mkdir($loc) ? true : false;
  }

  function deleteFolder($name){
    $loc = $this->folder."/".$name;
    
    return rmdir($loc) ? true : false;

  }
}

