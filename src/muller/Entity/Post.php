<?php

namespace muller\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="text")
     */
    private $conteudo;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    public function getConteudo(){
        return $this->conteudo;
    }
    
    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }

}
