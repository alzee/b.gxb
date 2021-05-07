<?php

namespace App\Controller\Admin;

use App\Entity\Vip;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vip::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['id', 'level', 'days'])
            ->setPaginatorPageSize(50);
    }

    public function configureFields(string $pageName): iterable
    {
        $level = TextField::new('level');
        $date = DateTimeField::new('date', 'vip.date');
        $days = IntegerField::new('days', 'vip.days');
        $uid = AssociationField::new('uid', 'vip.uid');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$uid, $level, $date, $days];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $level, $date, $days, $uid];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$level, $date, $days, $uid];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$level, $date, $days, $uid];
        }
    }
}
