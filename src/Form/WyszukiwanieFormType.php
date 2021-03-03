<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Wyszukiwanie;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class WyszukiwanieFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('Answer', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('Szukaj', SubmitType::class, array('attr' => array('class' => 'form-control')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Wyszukiwanie::class,
            ]);
        }
    }