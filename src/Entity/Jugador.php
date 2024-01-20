<?php

namespace App\Entity;

use App\Repository\JugadorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadorRepository::class)]
class Jugador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nombreJugador = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaNaci = null;

    #[ORM\Column]
    private ?int $estatura = null;

    #[ORM\Column(length: 12)]
    private ?string $posicion = null;

    #[ORM\ManyToOne(inversedBy: 'listaJugadores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipo $equipo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreJugador(): ?string
    {
        return $this->nombreJugador;
    }

    public function setNombreJugador(string $nombreJugador): static
    {
        $this->nombreJugador = $nombreJugador;

        return $this;
    }

    public function getFechaNaci(): ?\DateTimeInterface
    {
        return $this->fechaNaci;
    }

    public function setFechaNaci(\DateTimeInterface $fechaNaci): static
    {
        $this->fechaNaci = $fechaNaci;

        return $this;
    }

    public function getEstatura(): ?int
    {
        return $this->estatura;
    }

    public function setEstatura(int $estatura): static
    {
        $this->estatura = $estatura;

        return $this;
    }

    public function getPosicion(): ?string
    {
        return $this->posicion;
    }

    public function setPosicion(string $posicion): static
    {
        $this->posicion = $posicion;

        return $this;
    }

    public function getEquipo(): ?Equipo
    {
        return $this->equipo;
    }

    public function setEquipo(?Equipo $equipo): static
    {
        $this->equipo = $equipo;

        return $this;
    }
}
