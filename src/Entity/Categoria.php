<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 */
class Categoria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Musico", inversedBy="categoria")
     * @ORM\JoinColumn(nullable=false)
     */
    private $musico;

    public function getId()
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getMusico(): ?Musico
    {
        return $this->musico;
    }

    public function setMusico(?Musico $musico): self
    {
        $this->musico = $musico;

        return $this;
    }
}
