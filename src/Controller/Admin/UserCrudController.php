<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['id', 'username', 'roles', 'avatar', 'phone', 'topup', 'earnings', 'gxb', 'equity', 'frozen', 'refcode', 'coin'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail')
            ->disable('show');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('roles'));
    }

    public function configureFields(string $pageName): iterable
    {
        $username = TextField::new('username');
        $plainPassword = Field::new('plainPassword', 'edit.plainpass');
        $nick = TextField::new('nick');
        $avatarFile = Field::new('avatarFile', 'avatar');
        $phone = TextField::new('phone');
        $gxb = IntegerField::new('gxb');
        $level = AssociationField::new('level');
        $id = IntegerField::new('id', 'ID');
        $roles = TextField::new('roles');
        $avatar = ImageField::new('avatar')->setBasePath('/media');
        $topup = IntegerField::new('topup');
        $earnings = IntegerField::new('earnings');
        $updatedAt = DateTimeField::new('updatedAt');
        $equity = IntegerField::new('equity');
        $frozen = IntegerField::new('frozen');
        $refcode = TextField::new('refcode');
        $coin = IntegerField::new('coin');
        $date = DateTimeField::new('date');
        $applies = AssociationField::new('applies');
        $coupon = AssociationField::new('coupon');
        $referrer = AssociationField::new('referrer');
        $ror = AssociationField::new('ror');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $username, $phone, $topup, $earnings, $frozen, $equity, $coin, $gxb];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $username, $avatar, $phone, $topup, $earnings, $gxb, $equity, $frozen, $refcode, $coin, $date, $level, $referrer, $ror];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$username, $plainPassword, $phone];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$username, $plainPassword, $phone, $level];
        }
    }
}
