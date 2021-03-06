<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Budynki;
    use App\Entity\ObiektyNajmu;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ObiektyNajmuFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('Nr_mieszkania', TextType::class, array('invalid_message' => 'Nieprawidłowy numer mieszkania', 'attr' => array('class' => 'form-control')))
            ->add('Powierzchnia', TextType::class, array('invalid_message' => 'Nieprawidłowa wartość powierzchni', 'attr' => array('class' => 'form-control')))
            ->add('Rodzaj_obiektu', ChoiceType::class, array('choices' => ['Mieszkanie' => 'Mieszkanie', 'Pokój' => 'Pokój'], 'invalid_message' => 'Nieprawidłowy rodzaj obiektu', 'attr' => array('class' => 'form-control')))
            ->add('Liczba_pokoi', TextType::class, array('invalid_message' => 'Nieprawidłowa liczba pokoi', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Typ_mieszkania', TextType::class, array('invalid_message' => 'Nieprawidłowy typ mieszkania', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Nr_pokoju', TextType::class, array('invalid_message' => 'Nieprawidłowy numer pokoju', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Adres', EntityType::class, array('class' => Budynki::class, 'invalid_message' => 'Nieprawidłowy adres', 'attr' => array('class' => 'form-control')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => ObiektyNajmu::class
            ]);
        }
    }