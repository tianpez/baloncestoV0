<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombreEquipo = null;

    #[ORM\Column]
    private ?float $presupuesto = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaFunda = null;

    #[ORM\ManyToOne(inversedBy: 'listaEquipos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Zona $zona = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEquipo(): ?string
    {
        return $this->nombreEquipo;
    }

    public function setNombreEquipo(string $nombreEquipo): static
    {
        $this->nombreEquipo = $nombreEquipo;

        return $this;
    }

    public function getPresupuesto(): ?float
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(float $presupuesto): static
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getFechaFunda(): ?\DateTimeInterface
    {
        return $this->fechaFunda;
    }

    public function setFechaFunda(\DateTimeInterface $fechaFunda): static
    {
        $this->fechaFunda = $fechaFunda;

        return $this;
    }

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): static
    {
        $this->zona = $zona;

        return $this;
    }
}
