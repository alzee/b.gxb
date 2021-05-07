<?php

namespace App\Controller\Admin;

use App\Entity\NodeType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NodeTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NodeType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['id', 'name'])
            ->setPaginatorPageSize(50);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name];
        }
    }
}
