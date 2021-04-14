<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414061647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finance CHANGE more level_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE finance ADD CONSTRAINT FK_CE28EAE05FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('CREATE INDEX IDX_CE28EAE05FB14BA7 ON finance (level_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finance DROP FOREIGN KEY FK_CE28EAE05FB14BA7');
        $this->addSql('DROP INDEX IDX_CE28EAE05FB14BA7 ON finance');
        $this->addSql('ALTER TABLE finance CHANGE level_id more INT DEFAULT NULL');
    }
}
