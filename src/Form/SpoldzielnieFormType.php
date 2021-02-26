<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use App\Entity\Spoldzielnie;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    class SpoldzielnieFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
            ->add('nazwa', TextType::class, array('invalid_message' => 'Nieprawidłowa nazwa spółdzielni', 'attr' => array('class' => 'form-control')))
            ->add('adres', TextType::class, array('invalid_message' => 'Nieprawidłowy adres spółdzielni', 'attr' => array('class' => 'form-control')))
            ->add('nr_telefonu', TextType::class, array('invalid_message' => 'Nieprawidłowy numer telefonu', 'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Dodaj','attr' => array('class' => 'btn btn-primary mt-3')));
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data_class' => Spoldzielnie::class
            ]);
        }
    }