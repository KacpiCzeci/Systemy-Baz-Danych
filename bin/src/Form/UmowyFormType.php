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
            ->add('Nr_umowy', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Wynajem_od', DateType::class, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'invalid_message' => 'Nieprawidłowa data wynajmu.', 'years' => range(1960, date('Y')+20), 'attr' => array('class' => 'form-control')))
            ->add('Wynajem_do', DateType::class, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'invalid_message' => 'Nieprawidłowa data wynajmu.', 'years' => range(1960, date('Y')+20), 'attr' => array('class' => 'form-control')))
            ->add('Data_zawarcia_umowy', DateType::class, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'invalid_message' => 'Nieprawidłowa data zawarcia umowy.', 'years' => range(1960, date('Y')+20), 'attr' => array('class' => 'form-control')))
            ->add('Rodzaj_umowy', ChoiceType::class, array('choices' => ['Krótkoterminowe' => 'Krótkoterminowe', 'Długoterminowe' => 'Długoterminowe'], 'attr' => array('class' => 'form-control')))
            ->add('Lokator', EntityType::class, array('class' => Osoby::class, 'attr' => array('class' => 'form-control')))
            ->add('Wynajmujacy', EntityType::class, array('class' => Osoby::class, 'attr' => array('class' => 'form-control')))
            ->add('Mieszkanie', EntityType::class, array('class' => ObiektyNajmu::class, 'attr' => array('class' => 'form-control')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Umowy::class
            ]);
        }
    }