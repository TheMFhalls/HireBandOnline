<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CidadeRepository")
 */
class Cidade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estado", inversedBy="cidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bairro", mappedBy="cidade")
     */
    private $bairros;

    public function __construct()
    {
        $this->bairros = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): self
    {
        $this->estado = $estado;

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

    /**
     * @return Collection|Bairro[]
     */
    public function getBairros(): Collection
    {
        return $this->bairros;
    }

    public function addBairro(Bairro $bairro): self
    {
        if (!$this->bairros->contains($bairro)) {
            $this->bairros[] = $bairro;
            $bairro->setCidade($this);
        }

        return $this;
    }

    public function removeBairro(Bairro $bairro): self
    {
        if ($this->bairros->contains($bairro)) {
            $this->bairros->removeElement($bairro);
            // set the owning side to null (unless already changed)
            if ($bairro->getCidade() === $this) {
                $bairro->setCidade(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nome;
    }
}
