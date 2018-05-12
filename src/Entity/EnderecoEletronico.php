<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnderecoEletronicoRepository")
 */
class EnderecoEletronico
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="enderecoEletronicos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $enderecoEletronico;

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getEnderecoEletronico(): ?string
    {
        return $this->enderecoEletronico;
    }

    public function setEnderecoEletronico(string $enderecoEletronico): self
    {
        $this->enderecoEletronico = $enderecoEletronico;

        return $this;
    }
}
