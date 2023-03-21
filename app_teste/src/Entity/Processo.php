<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\ProcessoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcessoRepository::class)]
class Processo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $descricao = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $classificacao = null;

    #[ORM\Column(length: 255)]
    private ?string $observacao = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getClassificacao(): ?string
    {
        return $this->classificacao;
    }

    public function setClassificacao(string $classificacao): self
    {
        $this->classificacao = $classificacao;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }
}
