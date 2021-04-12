<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412030441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE level CHANGE post_fee post_fee DOUBLE PRECISION DEFAULT NULL, CHANGE withdraw_fee withdraw_fee DOUBLE PRECISION DEFAULT NULL, CHANGE sticky_fee sticky_fee DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE level CHANGE post_fee post_fee NUMERIC(3, 2) NOT NULL, CHANGE withdraw_fee withdraw_fee NUMERIC(3, 2) NOT NULL, CHANGE sticky_fee sticky_fee INT NOT NULL');
    }
}
