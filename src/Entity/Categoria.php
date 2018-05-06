<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=150)
     */
    private $nome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Musico", inversedBy="categorias")
     */
    private $musico;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Musico", mappedBy="categoria")
     */
    private $musicos;

    public function __construct()
    {
        $this->musico = new ArrayCollection();
        $this->musicos = new ArrayCollection();
    }

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

    /**
     * @return Collection|Musico[]
     */
    public function getMusico(): Collection
    {
        return $this->musico;
    }

    public function addMusico(Musico $musico): self
    {
        if (!$this->musico->contains($musico)) {
            $this->musico[] = $musico;
        }

        return $this;
    }

    public function removeMusico(Musico $musico): self
    {
        if ($this->musico->contains($musico)) {
            $this->musico->removeElement($musico);
        }

        return $this;
    }

    /**
     * @return Collection|Musico[]
     */
    public function getMusicos(): Collection
    {
        return $this->musicos;
    }
}
