<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\ObiektyNajmu;
    use App\Entity\Wyposazenie;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class WyposazenieFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('nazwa', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('ilosc', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Mieszkanie', EntityType::class, array('class' => ObiektyNajmu::class, 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Dodaj','attr' => array('class' => 'btn btn-primary mt-3')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Wyposazenie::class
            ]);
        }
    }