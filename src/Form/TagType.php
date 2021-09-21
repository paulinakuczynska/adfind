<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => false,
                'label' => 'Tag name',
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'This value cannot be blank.'
                    )),
                    new Length(array(
                        'min' => 1,
                        'max' => 30,
                        'maxMessage' => 'The name cannot contain more than 30 characters.'
                    )),
                    new Regex(array(
                        'pattern' => '/[^\w ]/',
                        'match' => false,
                        'message' => 'The name cannot contain special characters except for the low dash.'
                    )),
                )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Tag::class,
            'csrf_protection' => true,
            'csrf_field_name' => 'token',
            'csrf_token_id' => 'tag',
        ));
    }

}