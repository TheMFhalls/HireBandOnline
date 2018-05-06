<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MusicoRepository")
 */
class Musico
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Usuario", inversedBy="musico", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nome;

    /**
     * @ORM\Column(type="text")
     */
    private $historia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categoria", mappedBy="musico")
     */
    private $categoria;

    public function __construct()
    {
        $this->categoria = new ArrayCollection();
    }

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

    /**
     * @return Collection|Categoria[]
     */
    public function getCategoria(): Collection
    {
        return $this->categoria;
    }

    public function addCategorium(Categoria $categorium): self
    {
        if (!$this->categoria->contains($categorium)) {
            $this->categoria[] = $categorium;
            $categorium->setMusico($this);
        }

        return $this;
    }

    public function removeCategorium(Categoria $categorium): self
    {
        if ($this->categoria->contains($categorium)) {
            $this->categoria->removeElement($categorium);
            // set the owning side to null (unless already changed)
            if ($categorium->getMusico() === $this) {
                $categorium->setMusico(null);
            }
        }

        return $this;
    }
}
