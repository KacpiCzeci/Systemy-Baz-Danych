<?php

namespace App\Entity;

use App\Repository\SpoldzielnieRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=SpoldzielnieRepository::class)
 * @UniqueEntity("Nazwa", message = "Istnieje już społdzielnia o takiej nazwie")
 */
class Spoldzielnie
{
    /**
     * @Assert\NotNull(message = "Nieprawidłowa nazwa spółdzielni")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa społdzielni")
     * @ORM\Id
     * @ORM\Column(type="string", length=100)
     */
    private $Nazwa;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy adres spółdzielni")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długi adres społdzielni")
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Adres;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy numer telefonu")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowy numer telefonu")
     * @Assert\GreaterThanOrEqual(value = 100000000, message = "Nieprawidłowy numer telefonu")
     * @Assert\LessThanOrEqual(value  = 999999999, message = "Nieprawidłowy numer telefonu")
     * @ORM\Column(type="decimal", precision=9, nullable=false)
     */
    private $Nr_telefonu;

    public function __toString(){
        return $this->Nazwa;
    }

    public function getNazwa()
    {
        return $this->Nazwa;
    }

    public function setNazwa($Nazwa)
    {
        $this->Nazwa = $Nazwa;
    }

    public function getAdres()
    {
        return $this->Adres;
    }

    public function setAdres($Adres)
    {
        $this->Adres = $Adres;
    }

    public function getNrtelefonu()
    {
        return $this->Nr_telefonu;
    }

    public function setNrtelefonu($Nr_telefonu)
    {
        $this->Nr_telefonu = $Nr_telefonu;
    }
}
