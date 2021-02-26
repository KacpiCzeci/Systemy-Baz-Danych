<?php

namespace App\Entity;

use App\Repository\OsobyRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=OsobyRepository::class)
 * @UniqueEntity("PESEL", message = "Istnieje już osoba o takim PESELU")
 */
class Osoby
{
    /**
     * @Assert\NotNull(message = "Nieprawidłowy PESEL")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowy PESEL")
     * @Assert\GreaterThanOrEqual(value = 10000000000, message = "Nieprawidłowy PESEL")
     * @Assert\LessThanOrEqual(value  = 99999999999, message = "Nieprawidłowy PESEL")
     * @ORM\Id
     * @ORM\Column(type="decimal", precision=11)
     */
    private $PESEL;

    /**
     * @Assert\NotNull(message = "Nieprawidłowe imię")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Imie;

    /**
     * @Assert\NotNull(message = "Nieprawidłowe nazwisko")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Nazwisko;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy numer telefonu")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowy numer telefonu")
     * @Assert\GreaterThanOrEqual(value = 100000000, message = "Nieprawidłowy numer telefonu")
     * @Assert\LessThanOrEqual(value  = 999999999, message = "Nieprawidłowy numer telefonu")
     * @ORM\Column(type="decimal", precision=9, nullable=false)
     */
    private $Nr_telefonu;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy adres")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Adres;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Email;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy rodzaj osoby")
     * @ORM\Column(type="string", length=100, nullable=false, columnDefinition="ENUM('Lokator', 'Wynajmujacy')")
     */
    private $Rodzaj_osoby;

    public function __toString()
    {
        return $this->getPESEL();
    }

    public function getPESEL(): ?int
    {
        return $this->PESEL;
    }

    public function setPESEL($PESEL)
    {
        $this->PESEL = $PESEL;
    }

    public function getImie(): ?string
    {
        return $this->Imie;
    }

    public function setImie(string $Imie): self
    {
        $this->Imie = $Imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->Nazwisko;
    }

    public function setNazwisko(string $Nazwisko): self
    {
        $this->Nazwisko = $Nazwisko;

        return $this;
    }

    public function getNrTelefonu(): ?int
    {
        return $this->Nr_telefonu;
    }

    public function setNrTelefonu(int $Nr_telefonu): self
    {
        $this->Nr_telefonu = $Nr_telefonu;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->Adres;
    }

    public function setAdres(string $Adres): self
    {
        $this->Adres = $Adres;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getRodzajOsoby(): ?string
    {
        return $this->Rodzaj_osoby;
    }

    public function setRodzajOsoby(string $Rodzaj_osoby): self
    {
        $this->Rodzaj_osoby = $Rodzaj_osoby;

        return $this;
    }
}
