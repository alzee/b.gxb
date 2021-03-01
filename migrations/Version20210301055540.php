<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301055540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE node ADD author_id INT DEFAULT NULL, ADD up INT DEFAULT NULL, ADD down INT DEFAULT NULL, CHANGE date date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE node ADD CONSTRAINT FK_857FE845F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_857FE845F675F31B ON node (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE node DROP FOREIGN KEY FK_857FE845F675F31B');
        $this->addSql('DROP INDEX IDX_857FE845F675F31B ON node');
        $this->addSql('ALTER TABLE node DROP author_id, DROP up, DROP down, CHANGE date date TIME NOT NULL');
    }
}
