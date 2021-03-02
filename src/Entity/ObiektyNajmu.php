<?php

namespace App\Entity;

use App\Repository\ObiektyNajmuRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ObiektyNajmuRepository::class)
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
        $metadata->addConstraint(new UniqueEntity(['fields' => ['Nr_mieszkania', 'Adres'], 'message' => 'Istnieje już taki obiekt pod danym adresem.']));

        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\NotNull(['message' => 'Numer mieszkania nie może być pusty.']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\Type(['type' => 'numeric', 'message' => 'Numer mieszkania powinien być typu numerycznego.']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\Regex(['pattern' => '/^[0-9]{1,3}$/', 'message' => 'Nieprawidłowy format numeru mieszkania.']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Numer mieszkania nie powinien być mniejszy niż 1.']));
        $metadata->addPropertyConstraint('Nr_mieszkania', new Assert\LessThanOrEqual(['value' => 999, 'message' => 'Numer mieszkania nie powinien być większy niż 999.']));
        
        $metadata->addPropertyConstraint('Adres', new Assert\NotNull(['message' => 'Adres obiektu najmu nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Adres', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi adres obiektu najmu.']));
        
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\NotNull(['message' => 'Wartość powierzchni nie powinna być pusta.']));
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\Type(['type' => 'numeric', 'message' => 'Wartość powierzchni powinna być typu numerycznego.']));
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\GreaterThan(['value' => 0.00, 'message' => 'Powierzchna nie powinna być mniejsza niż 0.']));
        $metadata->addPropertyConstraint('Powierzchnia', new Assert\LessThanOrEqual(['value' => 9999999.99, 'message' => 'Powierzchnia nie powinna być większa niż 9999999.99.']));

        $metadata->addPropertyConstraint('Rodzaj_obiektu', new Assert\NotNull(['message' => 'Rodzaj obiektu nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Rodzaj_obiektu', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa rodzaju obiektu.']));

        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\Type(['type' => 'numeric', 'message' => 'Liczba pokoi powinna byyć typu numerycznego.']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\Regex(['pattern' => '/^[0-9]{1,2}$/', 'message' => 'Nieprawidłowy format liczby pokoi.']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Liczba pokoi powinna być nie mniejsza niz 1.']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\LessThanOrEqual(['value' => 99, 'message' => 'Liczba pokoi powinna być nie większa niz 99.']));
        $metadata->addPropertyConstraint('Liczba_pokoi', new Assert\Expression(['expression' => '(this.getRodzajObiektu() == "Mieszkanie" and this.getLiczbaPokoi() != null) or (this.getRodzajObiektu() != "Mieszkanie" and this.getLiczbaPokoi() == null)', 'message' => 'Wybrano niewłaściwą konfigurację lub wartość liczby pokoi jest pusta.']));

        $metadata->addPropertyConstraint('Typ_mieszkania', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa typu mieszkania.']));
        $metadata->addPropertyConstraint('Typ_mieszkania', new Assert\Expression(['expression' => '(this.getRodzajObiektu() == "Mieszkanie" and this.getTypMieszkania() != null) or (this.getRodzajObiektu() != "Mieszkanie" and this.getTypMieszkania() == null)', 'message' => 'Wybrano niewłaściwą konfigurację lub wartość typu mieszkania jest pusta.']));
        
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\Type(['type' => 'numeric', 'message' => 'Numer pokoju powinien być typu numerycznego.']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\Regex(['pattern' => '/^[0-9]{1,3}$/', 'message' => 'Nieprawidłowy format numeru pokoju.']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Numer pokoju powinien być nie mniejszy niż 1.']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\LessThanOrEqual(['value' => 999, 'message' => 'Numer pokoju powinien być nie większy niż 99.']));
        $metadata->addPropertyConstraint('Nr_pokoju', new Assert\Expression(['expression' => '(this.getRodzajObiektu() == "Pokój" and this.getNrPokoju() != null) or (this.getRodzajObiektu() != "Pokój" and this.getNrPokoju() == null)', 'message' => 'Wybrano niewłaściwą konfigurację lub wartośc numeru pokoju jest pusta.']));
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
