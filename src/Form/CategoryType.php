<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => false,
                'label' => 'Category name',
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'This value cannot be blank.'
                    )),
                    new Length(array(
                        'min' => 1,
                        'max' => 50,
                        'maxMessage' => 'The name cannot contain more than 50 characters.'
                    )),
                    new Regex(array(
                        'pattern' => '/[^\w ]/',
                        'match' => false,
                        'message' => 'The name cannot contain special characters except for the low dash.'
                    )),
                )))

            ->add('parent', EntityType::class, array(
                'class' => Category::class,
                'label' => 'Main category',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('p')
                        ->andWhere('p.parent is null');
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Category::class,
            'csrf_protection' => true,
            'csrf_field_name' => 'token',
            'csrf_token_id' => 'category',
        ));
    }

}