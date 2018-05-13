<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BairroRepository")
 */
class Bairro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cidade", inversedBy="bairros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    public function getId()
    {
        return $this->id;
    }

    public function getCidade(): ?Cidade
    {
        return $this->cidade;
    }

    public function setCidade(?Cidade $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
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
}
