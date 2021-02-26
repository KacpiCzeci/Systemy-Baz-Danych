<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Osoby;
    use App\Entity\ObiektyNajmu;
    use App\Entity\Umowy;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class UmowyFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('nr_umowy', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('wynajem_od', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('wynajem_do', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('data_zawarcia_umowy', DateType::class, array('attr' => array('class' => 'form-control')))
            ->add('rodzaj_umowy', ChoiceType::class, array('choices' => ['Krótkoterminowe' => 'Krótkoterminowe', 'Długoterminowe' => 'Długoterminowe'], 'attr' => array('class' => 'form-control')))
            ->add('Lokator', EntityType::class, array('class' => Osoby::class, 'attr' => array('class' => 'form-control')))
            ->add('Wynajmujacy', EntityType::class, array('class' => Osoby::class, 'attr' => array('class' => 'form-control')))
            ->add('Mieszkanie', EntityType::class, array('class' => ObiektyNajmu::class, 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Dodaj','attr' => array('class' => 'btn btn-primary mt-3')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Umowy::class
            ]);
        }
    }