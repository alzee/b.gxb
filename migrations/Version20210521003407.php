<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521003407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf ADD main_cell_min_price DOUBLE PRECISION NOT NULL, ADD cell_min_price DOUBLE PRECISION NOT NULL, ADD main_cell_min_days SMALLINT NOT NULL, ADD cell_min_days SMALLINT NOT NULL, DROP mainland_min_price, DROP land_min_price, DROP mainland_min_days, DROP land_min_days');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conf ADD mainland_min_price DOUBLE PRECISION NOT NULL, ADD land_min_price DOUBLE PRECISION NOT NULL, ADD mainland_min_days SMALLINT NOT NULL, ADD land_min_days SMALLINT NOT NULL, DROP main_cell_min_price, DROP cell_min_price, DROP main_cell_min_days, DROP cell_min_days');
    }
}
