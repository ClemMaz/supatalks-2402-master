<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '⌨️ All Posts')
            ->setEntityLabelInSingular('Post')
            ->setEntityLabelInPlural('Posts')
            ->setSearchFields(['title', 'isPublished'])
            ->setDefaultSort(['title' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Post Information'),
            TextField::new('Title')
                ->setLabel('Title')
                ->setHelp('What is the title of the post'),
            TextField::new('Content')
                ->setLabel('Content')
                ->setHelp('What is the content of the post?')
                ->hideOnIndex(),
            TextField::new('Image')
                ->setLabel('Image')
                ->setHelp('Set the illustration of the post')
                    ->hideOnIndex(),
            TextField::new('IsPublished')
                ->setLabel('IsPublished')
                ->setHelp('What is the publication statue?'),
            AssociationField::new('user_id')->hideOnIndex()
                ->setLabel('User')
                ->setHelp('Who write this article?'),
                    
        ];
    }
    
}
