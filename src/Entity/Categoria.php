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
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Musico", mappedBy="categoria")
     */
    private $musicos;

    public function __construct()
    {
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
    public function getMusicos(): Collection
    {
        return $this->musicos;
    }

    public function addMusico(Musico $musico): self
    {
        if (!$this->musicos->contains($musico)) {
            $this->musicos[] = $musico;
            $musico->addCategorium($this);
        }

        return $this;
    }

    public function removeMusico(Musico $musico): self
    {
        if ($this->musicos->contains($musico)) {
            $this->musicos->removeElement($musico);
            $musico->removeCategorium($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->nome;
    }
}
