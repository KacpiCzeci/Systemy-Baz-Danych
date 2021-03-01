<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Umowy;
    use App\Entity\Zwierzeta;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class ZwierzetaFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('Gatunek', TextType::class, array('invalid_message' => 'Nieprawidłowy gatunek', 'attr' => array('class' => 'form-control')))
            ->add('Ilosc', TextType::class, array('invalid_message' => 'Nieprawidłowa ilość', 'error_bubbling' => true, 'attr' => array('class' => 'form-control')))
            ->add('Id_umowy', EntityType::class, array('class' => Umowy::class, 'invalid_message' => 'Nieprawidłowe id umowy', 'attr' => array('class' => 'form-control')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Zwierzeta::class
            ]);
        }
    }