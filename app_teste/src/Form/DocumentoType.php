<?php

namespace App\Form;

use App\Entity\Documento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao',null,['required'=>"true"])
            ->add('numero',null,['required'=>"true"])
            ->add('autor')
            ->add('observacao')
            ->add('tipoDocumento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Documento::class,
        ]);
    }
}
