<?php

namespace App\Entity;

use App\Repository\WyposazenieRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=WyposazenieRepository::class)
 */
class Wyposazenie
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
    private $Nazwa;

    /**
     * @ORM\Column(type="decimal", precision=2, nullable=false)
     */
    private $Ilosc;

    /**
     * @ORM\ManyToOne(targetEntity="ObiektyNajmu")
     * @ORM\JoinColumn(name="Mieszkanie", referencedColumnName="mieszkanie")
     */
    private $Mieszkanie;

    public function getId()
    {
        return $this->id;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new UniqueEntity(['fields' => ['Nazwa', 'Mieszkanie'], 'message' => 'Istnieje już takie wyposażenie pod danym adresem.']));

        $metadata->addPropertyConstraint('Nazwa', new Assert\NotNull(['message' => 'Nazwa wyposażenia nie powinna być pusta.']));
        $metadata->addPropertyConstraint('Nazwa', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długa nazwa wyposażenia.']));
        $metadata->addPropertyConstraint('Nazwa', new Assert\Regex(['pattern' => '/^[a-zA-Z ]+$/', 'message' => 'Nieprawidłowy format nazwy wyposażenia.']));

        $metadata->addPropertyConstraint('Ilosc', new Assert\NotNull(['message' => 'Ilość wyposażenia nie powinna być pusta.']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\Type(['type' => 'numeric', 'message' => 'Ilość wyposażenia powinna być typu numerycznego.']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\Regex(['pattern' => '/^[0-9]{1,2}$/', 'message' => 'Nieprawidłowy format ilości wyposażenia.']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\GreaterThanOrEqual(['value' => 1, 'message' => 'Ilość wyposażenia nie powinna być mniejsza niż 1.']));
        $metadata->addPropertyConstraint('Ilosc', new Assert\LessThanOrEqual(['value' => 99, 'message' => 'Ilość wyposażenia nie powinna być większa niż 99.']));

        $metadata->addPropertyConstraint('Mieszkanie', new Assert\NotNull(['message' => 'Adres mieszkania nie powinien być pusty.']));
        $metadata->addPropertyConstraint('Mieszkanie', new Assert\Length(['max' => 100, 'maxMessage' => 'Zbyt długi adres mieszkania.']));
    }

    public function getNazwa()
    {
        return $this->Nazwa;
    }

    public function setNazwa($Nazwa)
    {
        $this->Nazwa = $Nazwa;
    }

    public function getIlosc()
    {
        return $this->Ilosc;
    }

    public function setIlosc($Ilosc)
    {
        $this->Ilosc = $Ilosc;
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
