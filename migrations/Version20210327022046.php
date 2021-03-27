<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210327022046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task ADD apply_until DATETIME DEFAULT NULL, ADD approve_until DATETIME DEFAULT NULL, DROP apply_hours, DROP approve_hours');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task ADD apply_hours DATETIME DEFAULT NULL, ADD approve_hours DATETIME DEFAULT NULL, DROP apply_until, DROP approve_until');
    }
}
