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
            ->add('nr_mieszkania', TextType::class, array('invalid_message' => 'Nieprawidłowy numer mieszkania', 'attr' => array('class' => 'form-control')))
            ->add('powierzchnia', TextType::class, array('invalid_message' => 'Nieprawidłowa wartość powierzchni', 'attr' => array('class' => 'form-control')))
            ->add('rodzaj_obiektu', ChoiceType::class, array('choices' => ['Mieszkanie' => 'Mieszkanie', 'Pokój' => 'Pokój'], 'invalid_message' => 'Nieprawidłowy rodzaj obiektu', 'attr' => array('class' => 'form-control')))
            ->add('liczba_pokoi', TextType::class, array('invalid_message' => 'Nieprawidłowa liczba pokoi', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('typ_mieszkania', TextType::class, array('invalid_message' => 'Nieprawidłowy typ mieszkania', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('nr_pokoju', TextType::class, array('invalid_message' => 'Nieprawidłowy numer pokoju', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Adres', EntityType::class, array('class' => Budynki::class, 'invalid_message' => 'Nieprawidłowy adres', 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Dodaj','attr' => array('class' => 'btn btn-primary mt-3')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => ObiektyNajmu::class
            ]);
        }
    }