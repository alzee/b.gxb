<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317014114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bid DROP INDEX UNIQ_4AF2B3F38DB60186, ADD INDEX IDX_4AF2B3F38DB60186 (task_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bid DROP INDEX IDX_4AF2B3F38DB60186, ADD UNIQUE INDEX UNIQ_4AF2B3F38DB60186 (task_id)');
    }
}
