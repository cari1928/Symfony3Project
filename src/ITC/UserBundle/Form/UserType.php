<?php

namespace ITC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',   TextType::class,        array("required"=>"required"))
            ->add('firstName',  TextType::class)
            ->add('lastName',   TextType::class)
            ->add('email',      EmailType::class,       array("required"=>"required"))
            ->add('password',   PasswordType::class,    array("required"=>"required"))
            ->add('role',       ChoiceType::class,      array('choices'=>array('Administrator'=>'ROLE_ADMIN', 
                                                            'User'=>'ROLE_USER'), 'placeholder'=>'Select a role'))
            ->add('isActive',   CheckboxType::class)
            ->add('save',       SubmitType::class,      array('label'=>'Save User'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ITC\UserBundle\Entity\User'
        ));
    }
    
    public function getName()
    {
        return 'itc_userbundle_user';
    }
}
