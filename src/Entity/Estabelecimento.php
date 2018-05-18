<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstabelecimentoRepository")
 */
class Estabelecimento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Usuario", inversedBy="estabelecimento", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bairro", inversedBy="estabelecimentos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bairro;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nome;

    /**
     * @ORM\Column(type="text")
     */
    private $historia;

    /**
     * @ORM\Column(type="text")
     */
    private $endereco;

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getBairro(): ?Bairro
    {
        return $this->bairro;
    }

    public function setBairro(?Bairro $bairro): self
    {
        $this->bairro = $bairro;

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

    public function getHistoria(): ?string
    {
        return $this->historia;
    }

    public function setHistoria(string $historia): self
    {
        $this->historia = $historia;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }
}
