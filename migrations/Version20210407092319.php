<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407092319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finance DROP INDEX UNIQ_CE28EAE0A76ED395, ADD INDEX IDX_CE28EAE0A76ED395 (user_id)');
        $this->addSql('ALTER TABLE finance ADD type INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finance DROP INDEX IDX_CE28EAE0A76ED395, ADD UNIQUE INDEX UNIQ_CE28EAE0A76ED395 (user_id)');
        $this->addSql('ALTER TABLE finance DROP type');
    }
}
