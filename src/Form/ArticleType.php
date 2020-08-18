<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('titre')
            ->add('content')
            ->add('image')
            ->add('createdAt',DateType::class , array(
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'data' => new \DateTime(),
    //                    'placeholder' => [
    //                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
    //                        'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
    //                    ]
    //                    'format' => 'dd/MM/yyyy'
                )
            )
            ->add('status')
            ->add('submit', SubmitType::class, array(
                    'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary border',
                ])
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
