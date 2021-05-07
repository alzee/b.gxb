<?php

namespace App\Controller\Admin;

use App\Entity\Node;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Node::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['id', 'title', 'up', 'down', 'body'])
            ->setPaginatorPageSize(50);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $type = AssociationField::new('type');
        $body = TextEditorField::new('body');
        $author = AssociationField::new('author');
        $up = IntegerField::new('up');
        $down = IntegerField::new('down');
        $date = DateTimeField::new('date');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $type, $body, $up, $down, $date, $author];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $date, $up, $down, $body, $author, $type];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$title, $type, $body, $author];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$title, $type, $body, $up, $down, $date, $author];
        }
    }
}
