<?php

namespace App\Controller\Admin;

use App\Entity\Finance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;

class WithdrawCrudController extends AbstractCrudController
{
    private $statuses = ['处理中' => 0, '失败' => 4, '已完成' => 5];

    public static function getEntityFqcn(): string
    {
        return Finance::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, '提现明细')
            ->setSearchFields(null)
            ->setPaginatorPageSize(50)
            ->setDefaultSort(['id' => 'DESC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new', 'delete');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('user'))
            ->add(ChoiceFilter::new('status')->setChoices($this->statuses))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $note = TextField::new('note');
        $date = DateTimeField::new('date');
        $amount = MoneyField::new('amount')->setCurrency('CNY');
        $prepayid = TextField::new('prepayid');
        $orderid = TextField::new('orderid');
        $wxOrderid = TextField::new('wx_orderid');
        $type = IntegerField::new('type');
        $status = ChoiceField::new('status')->setChoices($this->statuses);
        $couponId = IntegerField::new('couponId');
        $fee = MoneyField::new('fee')->setCurrency('CNY');
        $method = IntegerField::new('method');
        $data = ArrayField::new('data');
        $wxpayData = ArrayField::new('wxpayData');
        $user = AssociationField::new('user');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $user, $note, $date, $amount, $fee, $status];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $note, $date, $amount, $prepayid, $orderid, $wxOrderid, $type, $status, $couponId, $fee, $method, $user];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$note, $date, $amount, $prepayid, $orderid, $wxOrderid, $type, $status, $couponId, $fee, $method,  $user];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$status];
        }
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.type = 19 or entity.type = 18');
        return $response;
    }
}
