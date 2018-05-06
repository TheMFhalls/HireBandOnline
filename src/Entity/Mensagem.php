<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MensagemRepository")
 */
class Mensagem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="mensagens01")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario01;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="mensagens02")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario02;

    /**
     * @ORM\Column(type="text")
     */
    private $mensagem;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datahora;

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario01(): ?Usuario
    {
        return $this->usuario01;
    }

    public function setUsuario01(?Usuario $usuario01): self
    {
        $this->usuario01 = $usuario01;

        return $this;
    }

    public function getUsuario02(): ?Usuario
    {
        return $this->usuario02;
    }

    public function setUsuario02(?Usuario $usuario02): self
    {
        $this->usuario02 = $usuario02;

        return $this;
    }

    public function getMensagem(): ?string
    {
        return $this->mensagem;
    }

    public function setMensagem(string $mensagem): self
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    public function getDatahora(): ?\DateTimeInterface
    {
        return $this->datahora;
    }

    public function setDatahora(\DateTimeInterface $datahora): self
    {
        $this->datahora = $datahora;

        return $this;
    }
}
