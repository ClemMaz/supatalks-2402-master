<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '👤 All Users')
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
            ->setSearchFields(['nickname', 'role'])
            ->setDefaultSort(['nickname' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('User Information'),
            TextField::new('Nickname')
                ->setLabel('👤  Nickname')
                ->setHelp('Set the  nickname of the user'),
            TextField::new('Role')
                ->setLabel('👤 role')
                ->setHelp('Set the role name of the user'),
            TextField::new('password')
                ->setLabel('Password')
                ->setHelp('Set the password of the user')
                    ->hideOnIndex(),
            TextField::new('email')
                ->setLabel(' email')
                ->setHelp('What is the email of the user?')
                    ->hideOnIndex(),
        ];
    }
    
}
