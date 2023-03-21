<?php

namespace App\Entity;

use App\Repository\TipoDocumentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoDocumentoRepository::class)]
class TipoDocumento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $categoria = null;

    #[ORM\OneToMany(mappedBy: 'tipoDocumento', targetEntity: Documento::class)]
    private Collection $documentoList;

    public function __construct()
    {
        $this->documentoList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection<int, Documento>
     */
    public function getDocumentoList(): Collection
    {
        return $this->documentoList;
    }

    public function addDocumento(Documento $documento): self
    {
        if (!$this->documentoList->contains($documento)) {
            $this->documentoList->add($documento);
            $documento->setTipoDocumento($this);
        }

        return $this;
    }

    public function removeDocumento(Documento $documento): self
    {
        if ($this->documentoList->removeElement($documento)) {
            // set the owning side to null (unless already changed)
            if ($documento->getTipoDocumento() === $this) {
                $documento->setTipoDocumento(null);
            }
        }

        return $this;
    }

    public function __toString () {
        return $this->categoria;
    }
}
