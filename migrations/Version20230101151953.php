<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230101151953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE like_post (id INT AUTO_INCREMENT NOT NULL, post_share_id INT DEFAULT NULL, total INT DEFAULT NULL, date DATETIME DEFAULT NULL, INDEX IDX_83FFB0F3950BB67A (post_share_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE like_post ADD CONSTRAINT FK_83FFB0F3950BB67A FOREIGN KEY (post_share_id) REFERENCES post_share (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE like_post DROP FOREIGN KEY FK_83FFB0F3950BB67A');
        $this->addSql('DROP TABLE like_post');
    }
}
