<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Osoby;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class OsobyFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('PESEL', TextType::class, array('invalid_message' => 'Nieprawidłowy PESEL', 'attr' => array('class' => 'form-control')))
            ->add('imie', TextType::class, array('invalid_message' => 'Nieprawidłowe imię', 'attr' => array('class' => 'form-control')))
            ->add('nazwisko', TextType::class, array('invalid_message' => 'Nieprawidłowe nazwisko', 'attr' => array('class' => 'form-control')))
            ->add('nr_telefonu', TextType::class, array('invalid_message' => 'Nieprawidłowy numer telefonu', 'attr' => array('class' => 'form-control')))
            ->add('adres', TextType::class, array('invalid_message' => 'Nieprawidłowy adres', 'attr' => array('class' => 'form-control')))
            ->add('email', TextType::class, array('invalid_message' => 'Nieprawidłowy e-mail', 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('rodzaj_osoby', ChoiceType::class, array('choices' => ['Lokator' => 'Lokator', 'Wynajmujący' => 'Wynajmujący'], 'attr' => array('class' => 'form-control')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Osoby::class
            ]);
        }
    }