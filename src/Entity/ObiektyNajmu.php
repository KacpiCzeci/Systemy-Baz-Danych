<?php

namespace App\Entity;

use App\Repository\ObiektyNajmuRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

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
     * @ORM\Column(type="decimal", precision=3, nullable=false)
     */
    private $Nr_mieszkania;

    /**
     * @ORM\ManyToOne(targetEntity="Budynki")
     * @ORM\JoinColumn(name="Adres", referencedColumnName="adres")
     */
    private $Adres;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2, nullable=false)
     */
    private $Powierzchnia;

    /**
     * @ORM\Column(type="string", length=100, nullable=false, columnDefinition="ENUM('Mieszkanie', 'Pokój')")
     */
    private $Rodzaj_obiektu;

    /**
     * @ORM\Column(type="decimal", precision=2, nullable=true)
     */
    private $Liczba_pokoi;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Typ_mieszkania;

    /**
     * @ORM\Column(type="decimal", precision=3, nullable=true)
     */
    private $Nr_pokoju;

    public function __toString()
    {
        return $this->Adres . ' / ' . $this->Nr_mieszkania;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\NotNull(['message' => 'Nieprawidłowy numer mieszkania']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\Type(['type' => 'numeric', 'message' => 'Nieprawidłowy numer mieszkania']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\Type(['type' => 'integer', 'message' => 'Nieprawidłowy numer mieszkania']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Nieprawidłowy numer mieszkania']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\LessThanOrEqual(['value' => 999, 'message' => 'Nieprawidłowy numer mieszkania']));
        
        $metadata->addPropertyConstraint('Adres', new Assert\NotNull(['message' => 'Nieprawidłowy adres obiektu najmu']));
        $metadata->addPropertyConstraint('Adres', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi adres obiektu najmu']));
        $metadata->addPropertyConstraint('Adres', new Assert\Regex(['pattern' => '/^[a-zA-Z ]+[0-9]*$/', 'message' => 'Nieprawidłowy adres obiektu najmu']));
        
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\NotNull(['message' => 'Nieprawidłowa wartość powierzchni']));
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\Type(['type' => 'numeric', 'message' => 'Nieprawidłowa wartość powierzchni']));
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\GreaterThanOrEqual(['value' => 0.00, 'message' => 'Nieprawidłowa wartość powierzchni']));
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\LessThanOrEqual(['value' => 9999999.99, 'message' => 'Nieprawidłowa wartość powierzchni']));

        $metadata->addPropertyConstraint('Rodzaj_obiektu', new Assert\NotNull(['message' => 'Nieprawidłowy rodzaj obiektu']));
        $metadata->addPropertyConstraint('Rodzaj_obiektu', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa rodzaju obiektu']));

        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\Type(['type' => 'numeric', 'message' => 'Nieprawidłowa liczba pokoi']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\Type(['type' => 'integer', 'message' => 'Nieprawidłowa liczba pokoi']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Nieprawidłowa liczba pokoi']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\LessThanOrEqual(['value' => 99, 'message' => 'Nieprawidłowa liczba pokoi']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\Expression(['expression' => '!(this.getRodzajObiektu() == "Mieszkanie" and this.getLiczbaPokoi() == null)', 'message' => 'Uzupełnij liczbę pokoi']));

        $metadata->addPropertyConstraint('Typ_mieszkania', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa typu mieszkania']));
        $metadata->addPropertyConstraint('Typ_mieszkania', new Assert\Expression(['expression' => '!(this.getRodzajObiektu() == "Mieszkanie" and this.getTypMieszkania() == null)', 'message' => 'Uzupełnij typ mieszkania']));
        
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\Type(['type' => 'numeric', 'message' => 'Nieprawidłowy numer pokoju']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\Type(['type' => 'integer', 'message' => 'Nieprawidłowy numer pokoju']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Nieprawidłowy numer pokoju']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\LessThanOrEqual(['value' => 999, 'message' => 'Nieprawidłowy numer pokoju']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\Expression(['expression' => '!(this.getRodzajObiektu() == "Pokój" and this.getNrPokoju() == null)', 'message' => 'Uzupełnij numer pokoju']));
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
