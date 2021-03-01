<?php

namespace App\Entity;

use App\Repository\OsobyRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=OsobyRepository::class)
 */
class Osoby
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=11)
     */
    private $PESEL;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Imie;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Nazwisko;

    /**
     * @ORM\Column(type="string", length=9, nullable=false)
     */
    private $Nr_telefonu;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Adres;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=100, nullable=false, columnDefinition="ENUM('Lokator', 'Wynajmujacy')")
     */
    private $Rodzaj_osoby;

    public function __toString()
    {
        return $this->getPESEL();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new UniqueEntity(['fields' => 'PESEL', 'message' => 'Istnieje już osoba o takim PESELU']));

        $metadata->addPropertyConstraint('PESEL', new Assert\NotNull(['message' => 'Nieprawidłowy PESEL']));
        $metadata->addPropertyConstraint('PESEL', new Assert\Regex(['pattern' => '/^[0-9]{11}$/', 'message' => 'Nieprawidłowy PESEL']));
        
        $metadata->addPropertyConstraint('Imie', new Assert\NotNull(['message' => 'Nieprawidłowe imię']));
        $metadata->addPropertyConstraint('Imie', new Assert\Regex(['pattern'=> '/^[A-Z][a-z]+$/', 'message' => 'Nieprawidłowe imię']));
        $metadata->addPropertyConstraint('Imie', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długie imię']));

        $metadata->addPropertyConstraint('Nazwisko', new Assert\NotNull(['message' => 'Nieprawidłowe nazwisko']));
        $metadata->addPropertyConstraint('Nazwisko', new Assert\Regex(['pattern'=> '/^[A-Z][a-z]+$/', 'message' => 'Nieprawidłowe nazwisko']));
        $metadata->addPropertyConstraint('Nazwisko', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długie nazwisko']));
        
        $metadata->addPropertyConstraint('Nr_telefonu', new Assert\NotNull(['message' => 'Nieprawidłowy numer telefonu']));
        $metadata->addPropertyConstraint('Nr_telefonu', new Assert\Regex(['pattern' => '/^[0-9]{9}$/', 'message' => 'Nieprawidłowy numer telefonu']));
        
        $metadata->addPropertyConstraint('Adres', new Assert\NotNull(['message' => 'Nieprawidłowy adres']));
        $metadata->addPropertyConstraint('Adres', new Assert\Regex(['pattern' => '/^[a-zA-Z ]+[0-9]+$/', 'message' => 'Nieprawidłowy adres']));
        $metadata->addPropertyConstraint('Adres', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi adres']));

        $metadata->addPropertyConstraint('Email', new Assert\Regex(['pattern' => '/^.+@.+\..+$/', 'message' => 'Nieprawidłowy email']));
        $metadata->addPropertyConstraint('Email', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa adres email']));
        
        $metadata->addPropertyConstraint('Rodzaj_osoby', new Assert\NotNull(['message' => 'Nieprawidłowy rodzaj osoby']));
        $metadata->addPropertyConstraint('Rodzaj_osoby', new Assert\Length(['max' => 100, 'maxMessage' => 'Nieprawidłowy rodzaj osoby']));
    }

    public function getPESEL()
    {
        return $this->PESEL;
    }

    public function setPESEL($PESEL)
    {
        $this->PESEL = $PESEL;
    }

    public function getImie()
    {
        return $this->Imie;
    }

    public function setImie($Imie)
    {
        $this->Imie = $Imie;
    }

    public function getNazwisko()
    {
        return $this->Nazwisko;
    }

    public function setNazwisko($Nazwisko)
    {
        $this->Nazwisko = $Nazwisko;
    }

    public function getNrTelefonu()
    {
        return $this->Nr_telefonu;
    }

    public function setNrTelefonu($Nr_telefonu)
    {
        $this->Nr_telefonu = $Nr_telefonu;
    }

    public function getAdres()
    {
        return $this->Adres;
    }

    public function setAdres($Adres)
    {
        $this->Adres = $Adres;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getRodzajOsoby()
    {
        return $this->Rodzaj_osoby;
    }

    public function setRodzajOsoby($Rodzaj_osoby)
    {
        $this->Rodzaj_osoby = $Rodzaj_osoby;
    }
}
