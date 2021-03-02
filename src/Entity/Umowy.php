<?php

namespace App\Entity;

use App\Repository\UmowyRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UmowyRepository::class)
 */
class Umowy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $Nr_umowy;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $Wynajem_od;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $Wynajem_do;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $Data_zawarcia_umowy;

    /**
    * @ORM\Column(type="string", length=100, nullable=false, columnDefinition="ENUM('Krótkoterminowe', 'Długoterminowe')")
    */
    private $Rodzaj_umowy;

    /**
     * @ORM\ManyToOne(targetEntity="Osoby")
     * @ORM\JoinColumn(name="Lokator", referencedColumnName="pesel")
     */
    private $Lokator;

    /**
     * @ORM\ManyToOne(targetEntity="Osoby")
     * @ORM\JoinColumn(name="Wynajmujacy", referencedColumnName="pesel")
     */
    private $Wynajmujacy;

    /**
     * @ORM\ManyToOne(targetEntity="ObiektyNajmu")
     * @ORM\JoinColumn(name="Mieszkanie", referencedColumnName="mieszkanie")
     */
    private $Mieszkanie;

    public function __toString()
    {
        return $this->getNrUmowy();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new UniqueEntity(['fields' => 'Nr_umowy', 'message' => 'Istnieje już taka umowa.']));

        $metadata->addPropertyConstraint('Nr_umowy', new Assert\NotNull(['message' => 'Numer umowy nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Nr_umowy', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi numer umowy.']));

        $metadata->addPropertyConstraint('Wynajem_od', new Assert\NotNull(['message' => 'Data wynajmu nie powinna być pusta.']));

        $metadata->addPropertyConstraint('Wynajem_do', new Assert\NotNull(['message' => 'Data wynajmu nie powinna być pusta.']));
        $metadata->addPropertyConstraint('Wynajem_do', new Assert\Expression(['expression' => 'this.getWynajemod() <= this.getWynajemdo()', 'message' => 'Data początku wynajmu jest poźniejsza niż data zakończenia.']));

        $metadata->addPropertyConstraint('Data_zawarcia_umowy', new Assert\NotNull(['message' => 'Data zawarcia umowy nie powinna być pusta.']));
        $metadata->addPropertyConstraint('Data_zawarcia_umowy', new Assert\Expression(['expression' => 'this.getDatazawarciaumowy() <= this.getWynajemod()', 'message' => 'Data zawarcia umowy jest poźniejsza niż data początku wynajmu.']));

        $metadata->addPropertyConstraint('Rodzaj_umowy', new Assert\NotNull(['message' => 'Rodzaj umowy nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Rodzaj_umowy', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa rodzaju obiektu.']));

        $metadata->addPropertyConstraint('Lokator', new Assert\NotNull(['message' => 'PESEL lokatora nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Lokator', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi PESEL lokatora.']));
        
        $metadata->addPropertyConstraint('Wynajmujacy', new Assert\NotNull(['message' => 'PESEL wynajmującego nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Wynajmujacy', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi PESEL wynajmującego.']));
        $metadata->addPropertyConstraint('Wynajmujacy', new Assert\Expression(['expression' => 'this.getWynajmujacy() != this.getLokator()', 'message' => 'PESEL lokatora i wynajmującego powinny być inne.']));
        
        $metadata->addPropertyConstraint('Mieszkanie', new Assert\NotNull(['message' => 'Nazwa mieszkania nie powinna być pusta.']));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNrumowy()
    {
        return $this->Nr_umowy;
    }

    public function setNrumowy($Nr_umowy)
    {
        $this->Nr_umowy = $Nr_umowy;
    }

    public function getWynajemod()
    {
        return $this->Wynajem_od;
    }

    public function setWynajemod($Wynajem_od)
    {
        $this->Wynajem_od = $Wynajem_od;
    }

    public function getWynajemdo()
    {
        return $this->Wynajem_do;
    }

    public function setWynajemdo($Wynajem_do)
    {
        $this->Wynajem_do = $Wynajem_do;
    }

    public function getDatazawarciaumowy()
    {
        return $this->Data_zawarcia_umowy;
    }

    public function setDatazawarciaumowy($Data_zawarcia_umowy)
    {
        $this->Data_zawarcia_umowy = $Data_zawarcia_umowy;
    }

    public function getRodzajumowy()
    {
        return $this->Rodzaj_umowy;
    }

    public function setRodzajumowy($Rodzaj_umowy)
    {
        $this->Rodzaj_umowy = $Rodzaj_umowy;
    }

    public function getLokator()
    {
        return $this->Lokator;
    }

    public function setLokator($Lokator)
    {
        $this->Lokator = $Lokator;
    }

    public function getWynajmujacy()
    {
        return $this->Wynajmujacy;
    }

    public function setWynajmujacy($Wynajmujacy)
    {
        $this->Wynajmujacy = $Wynajmujacy;
    }

    public function getMieszkanie()
    {
        return $this->Mieszkanie;
    }

    public function setMieszkanie($Mieszkanie)
    {
        $this->Mieszkanie = $Mieszkanie;
    }
}
