<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
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
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $senha;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $login;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Telefone", mappedBy="usuario")
     */
    private $telefones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Email", mappedBy="usuario")
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Foto", mappedBy="usuario")
     */
    private $fotos;

    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->fotos = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return Collection|Telefone[]
     */
    public function getTelefones(): Collection
    {
        return $this->telefones;
    }

    public function addTelefone(Telefone $telefone): self
    {
        if (!$this->telefones->contains($telefone)) {
            $this->telefones[] = $telefone;
            $telefone->setUsuario($this);
        }

        return $this;
    }

    public function removeTelefone(Telefone $telefone): self
    {
        if ($this->telefones->contains($telefone)) {
            $this->telefones->removeElement($telefone);
            // set the owning side to null (unless already changed)
            if ($telefone->getUsuario() === $this) {
                $telefone->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->login;
    }

    /**
     * @return Collection|Email[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Email $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setUsuario($this);
        }

        return $this;
    }

    public function removeEmail(Email $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
            // set the owning side to null (unless already changed)
            if ($email->getUsuario() === $this) {
                $email->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Foto[]
     */
    public function getFotos(): Collection
    {
        return $this->fotos;
    }

    public function addFoto(Foto $foto): self
    {
        if (!$this->fotos->contains($foto)) {
            $this->fotos[] = $foto;
            $foto->setUsuario($this);
        }

        return $this;
    }

    public function removeFoto(Foto $foto): self
    {
        if ($this->fotos->contains($foto)) {
            $this->fotos->removeElement($foto);
            // set the owning side to null (unless already changed)
            if ($foto->getUsuario() === $this) {
                $foto->setUsuario(null);
            }
        }

        return $this;
    }
}
