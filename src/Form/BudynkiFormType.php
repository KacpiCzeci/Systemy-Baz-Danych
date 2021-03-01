<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Budynki;
    use App\Entity\Spoldzielnie;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\ButtonType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class BudynkiFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('adres', TextType::class, array('invalid_message' => 'Nieprawidłowy adres', 'attr' => array('class' => 'form-control')))
            ->add('typ', TextType::class, array('invalid_message' => 'Nieprawidłowy typ', 'attr' => array('class' => 'form-control')))
            ->add('Nazwa', EntityType::class, array('class' => Spoldzielnie::class, 'choice_label' => 'getNazwa', 'invalid_message' => 'Nieprawidłowa nazwa', 'attr' => array('class' => 'form-control')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Budynki::class,
            ]);
        }
    }