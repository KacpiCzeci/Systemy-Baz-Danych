<?php

namespace App\Entity;

use App\Repository\ObiektyNajmuRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ObiektyNajmuRepository::class)
 * @UniqueEntity(fields={"Nr_mieszkania", "Adres"}, message = "Istnieje już taki obiekt pod danym adresem")
 */
class ObiektyNajmu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $Mieszkanie;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy numer mieszkania")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowy numer mieszkania")
     * @Assert\GreaterThanOrEqual(value = 1, message = "Nieprawidłowy numer mieszkania")
     * @Assert\LessThanOrEqual(value  = 999, message = "Nieprawidłowy numer mieszkania")
     * @ORM\Column(type="decimal", precision=3, nullable=false)
     */
    private $Nr_mieszkania;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy adres obiektu najmu")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długi adres obiektu najmu")
     * @ORM\ManyToOne(targetEntity="Budynki")
     * @ORM\JoinColumn(name="Adres", referencedColumnName="adres")
     */
    private $Adres;

    /**
     * @Assert\NotNull(message = "Nieprawidłowa wartość powierzchni")
     * @Assert\Type(type = "numeric", message = "Nieprawidłowa wartość powierzchni")
     * @Assert\GreaterThanOrEqual(value = 0.00, message = "Nieprawidłowa wartość powierzchni")
     * @Assert\LessThanOrEqual(value  = 9999999.99, message = "Nieprawidłowa wartość powierzchni")
     * @ORM\Column(type="decimal", precision=7, scale=2, nullable=false)
     */
    private $Powierzchnia;

    /**
     * @Assert\NotNull(message = "Nieprawidłowy rodzaj obiektu")
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa rodzaju obiektu")
     * @ORM\Column(type="string", length=100, nullable=false, columnDefinition="ENUM('Mieszkanie', 'Pokój')")
     */
    private $Rodzaj_obiektu;

    /**
     * @Assert\Type(type = "numeric", message = "Nieprawidłowa liczba pokoi")
     * @Assert\GreaterThanOrEqual(value = 1, message = "Nieprawidłowa liczba pokoi")
     * @Assert\LessThanOrEqual(value  = 99, message = "Nieprawidłowa liczba pokoi")
     * @Assert\Expression(expression = "!(this.getRodzajObiektu() == 'Mieszkanie' and this.getLiczbaPokoi() == null)", message = "Uzupełnij liczbę pokoi")
     * @ORM\Column(type="decimal", precision=2, nullable=true)
     */
    private $Liczba_pokoi;

    /**
     * @Assert\Length(max = 100, maxMessage = "Zbyt długa nazwa typu mieszkania")
     * @Assert\Expression(expression = "!(this.getRodzajObiektu() == 'Mieszkanie' and this.getTypMieszkania() == null)", message = "Uzupełnij typ mieszkania")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Typ_mieszkania;

    /**
     * @Assert\Type(type = "numeric", message = "Nieprawidłowy numer pokoju")
     * @Assert\GreaterThanOrEqual(value = 1, message = "Nieprawidłowy numer pokoju")
     * @Assert\LessThanOrEqual(value  = 999, message = "Nieprawidłowy numer pokoju")
     * @Assert\Expression(expression = "!(this.getRodzajObiektu() == 'Pokój' and this.getNrPokoju() == null)", message = "Uzupełnij numer pokoju")
     * @ORM\Column(type="decimal", precision=3, nullable=true)
     */
    private $Nr_pokoju;

    public function __toString()
    {
        return $this->Adres . ' / ' . $this->Nr_mieszkania;
    }

    public function getMieszkanie()
    {
        return $this->Mieszkanie;
    }

    public function getNrMieszkania()
    {
        return $this->Nr_mieszkania;
    }

    public function setNrMieszkania($Nr_mieszkania)
    {
        $this->Nr_mieszkania = $Nr_mieszkania;
    }

    public function getAdres()
    {
        return $this->Adres;
    }

    public function setAdres($Adres)
    {
        $this->Adres = $Adres;
    }

    public function getPowierzchnia()
    {
        return $this->Powierzchnia;
    }

    public function setPowierzchnia($Powierzchnia)
    {
        $this->Powierzchnia = $Powierzchnia;
    }

    public function getRodzajObiektu()
    {
        return $this->Rodzaj_obiektu;
    }

    public function setRodzajObiektu($Rodzaj_obiektu)
    {
        $this->Rodzaj_obiektu = $Rodzaj_obiektu;
    }

    public function getLiczbaPokoi()
    {
        return $this->Liczba_pokoi;
    }

    public function setLiczbaPokoi($Liczba_pokoi)
    {
        $this->Liczba_pokoi = $Liczba_pokoi;
    }

    public function getTypMieszkania()
    {
        return $this->Typ_mieszkania;
    }

    public function setTypMieszkania($Typ_mieszkania)
    {
        $this->Typ_mieszkania = $Typ_mieszkania;
    }

    public function getNrPokoju()
    {
        return $this->Nr_pokoju;
    }

    public function setNrPokoju($Nr_pokoju)
    {
        $this->Nr_pokoju = $Nr_pokoju;
    }
}
