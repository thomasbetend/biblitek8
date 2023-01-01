<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230101172943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ideal_bibliotheque (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, book1 VARCHAR(255) DEFAULT NULL, book2 VARCHAR(255) DEFAULT NULL, book3 VARCHAR(255) DEFAULT NULL, book4 VARCHAR(255) DEFAULT NULL, book5 VARCHAR(255) DEFAULT NULL, INDEX IDX_757448C9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ideal_bibliotheque ADD CONSTRAINT FK_757448C9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ideal_bibliotheque DROP FOREIGN KEY FK_757448C9A76ED395');
        $this->addSql('DROP TABLE ideal_bibliotheque');
    }
}
