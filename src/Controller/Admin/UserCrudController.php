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
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

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
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(50);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail')
            ->disable('show', 'new');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('level'))
            ->add(NumericFilter::new('coin'))
            ->add(BooleanFilter::new('active'))
        ;
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
        $topup = MoneyField::new('topup')->setCurrency('CNY');
        $earnings = MoneyField::new('earnings')->setCurrency('CNY');
        $frozen = MoneyField::new('frozen')->setCurrency('CNY');
        $updatedAt = DateTimeField::new('updatedAt');
        $equity = IntegerField::new('equity');
        $refcode = TextField::new('refcode');
        $coin = IntegerField::new('coin');
        $date = DateTimeField::new('date');
        $vipUntil = DateTimeField::new('vipUntil');
        $applies = AssociationField::new('applies');
        $coupon = AssociationField::new('coupon');
        $referrer = AssociationField::new('referrer');
        $ror = AssociationField::new('ror');
        $active = BooleanField::new('active')->renderAsSwitch(false);

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $username, $phone, $topup, $earnings, $frozen, $equity, $coin, $gxb, $level, $active];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $username, $avatar, $phone, $topup, $earnings, $gxb, $equity, $frozen, $refcode, $coin, $date, $level, $vipUntil, $referrer, $ror];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$username, $plainPassword, $phone];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$level, $gxb, $active, $plainPassword];
        }
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $response;
    }
}
