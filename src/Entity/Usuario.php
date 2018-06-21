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
     * @ORM\Column(type="string", length=150, unique=true)
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
     * @ORM\OneToMany(targetEntity="App\Entity\Foto", mappedBy="usuario")
     */
    private $fotos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mensagem", mappedBy="usuario01")
     */
    private $mensagens01;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mensagem", mappedBy="usuario02")
     */
    private $mensagens02;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="usuario")
     */
    private $videos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Musico", mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $musico;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EnderecoEletronico", mappedBy="usuario")
     */
    private $enderecoEletronicos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Estabelecimento", mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $estabelecimento;

    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->fotos = new ArrayCollection();
        $this->mensagens01 = new ArrayCollection();
        $this->mensagens02 = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->enderecoEletronicos = new ArrayCollection();
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

    /**
     * @return Collection|Mensagem[]
     */
    public function getMensagens01(): Collection
    {
        return $this->mensagens01;
    }

    public function addMensagens01(Mensagem $mensagens01): self
    {
        if (!$this->mensagens01->contains($mensagens01)) {
            $this->mensagens01[] = $mensagens01;
            $mensagens01->setUsuario01($this);
        }

        return $this;
    }

    public function removeMensagens01(Mensagem $mensagens01): self
    {
        if ($this->mensagens01->contains($mensagens01)) {
            $this->mensagens01->removeElement($mensagens01);
            // set the owning side to null (unless already changed)
            if ($mensagens01->getUsuario01() === $this) {
                $mensagens01->setUsuario01(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mensagem[]
     */
    public function getMensagens02(): Collection
    {
        return $this->mensagens02;
    }

    public function addMensagens02(Mensagem $mensagens02): self
    {
        if (!$this->mensagens02->contains($mensagens02)) {
            $this->mensagens02[] = $mensagens02;
            $mensagens02->setUsuario02($this);
        }

        return $this;
    }

    public function removeMensagens02(Mensagem $mensagens02): self
    {
        if ($this->mensagens02->contains($mensagens02)) {
            $this->mensagens02->removeElement($mensagens02);
            // set the owning side to null (unless already changed)
            if ($mensagens02->getUsuario02() === $this) {
                $mensagens02->setUsuario02(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setUsuario($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getUsuario() === $this) {
                $video->setUsuario(null);
            }
        }

        return $this;
    }

    public function getMusico(): ?Musico
    {
        return $this->musico;
    }

    public function setMusico(Musico $musico): self
    {
        $this->musico = $musico;

        // set the owning side of the relation if necessary
        if ($this !== $musico->getUsuario()) {
            $musico->setUsuario($this);
        }

        return $this;
    }

    /**
     * @return Collection|EnderecoEletronico[]
     */
    public function getEnderecoEletronicos(): Collection
    {
        return $this->enderecoEletronicos;
    }

    public function addEnderecoEletronico(EnderecoEletronico $enderecoEletronico): self
    {
        if (!$this->enderecoEletronicos->contains($enderecoEletronico)) {
            $this->enderecoEletronicos[] = $enderecoEletronico;
            $enderecoEletronico->setUsuario($this);
        }

        return $this;
    }

    public function removeEnderecoEletronico(EnderecoEletronico $enderecoEletronico): self
    {
        if ($this->enderecoEletronicos->contains($enderecoEletronico)) {
            $this->enderecoEletronicos->removeElement($enderecoEletronico);
            // set the owning side to null (unless already changed)
            if ($enderecoEletronico->getUsuario() === $this) {
                $enderecoEletronico->setUsuario(null);
            }
        }

        return $this;
    }

    public function getEstabelecimento(): ?Estabelecimento
    {
        return $this->estabelecimento;
    }

    public function setEstabelecimento(Estabelecimento $estabelecimento): self
    {
        $this->estabelecimento = $estabelecimento;

        // set the owning side of the relation if necessary
        if ($this !== $estabelecimento->getUsuario()) {
            $estabelecimento->setUsuario($this);
        }

        return $this;
    }
}
