<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Estabelecimento", mappedBy="bairro")
     */
    private $estabelecimentos;

    public function __construct()
    {
        $this->estabelecimentos = new ArrayCollection();
    }

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

    /**
     * @return Collection|Estabelecimento[]
     */
    public function getEstabelecimentos(): Collection
    {
        return $this->estabelecimentos;
    }

    public function addEstabelecimento(Estabelecimento $estabelecimento): self
    {
        if (!$this->estabelecimentos->contains($estabelecimento)) {
            $this->estabelecimentos[] = $estabelecimento;
            $estabelecimento->setBairro($this);
        }

        return $this;
    }

    public function removeEstabelecimento(Estabelecimento $estabelecimento): self
    {
        if ($this->estabelecimentos->contains($estabelecimento)) {
            $this->estabelecimentos->removeElement($estabelecimento);
            // set the owning side to null (unless already changed)
            if ($estabelecimento->getBairro() === $this) {
                $estabelecimento->setBairro(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nome;
    }
}
