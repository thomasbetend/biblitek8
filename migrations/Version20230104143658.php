<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104143658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_like3 DROP FOREIGN KEY FK_A80D8302950BB67A');
        $this->addSql('ALTER TABLE post_like3 DROP FOREIGN KEY FK_A80D8302A76ED395');
        $this->addSql('ALTER TABLE post_like2 DROP FOREIGN KEY FK_DF0AB394950BB67A');
        $this->addSql('DROP TABLE post_like3');
        $this->addSql('DROP TABLE post_like2');
        $this->addSql('DROP TABLE post_like');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_like3 (id INT AUTO_INCREMENT NOT NULL, post_share_id INT DEFAULT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, total INT DEFAULT NULL, INDEX IDX_A80D8302950BB67A (post_share_id), INDEX IDX_A80D8302A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_like2 (id INT AUTO_INCREMENT NOT NULL, post_share_id INT DEFAULT NULL, total INT DEFAULT NULL, INDEX IDX_DF0AB394950BB67A (post_share_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_like (id INT AUTO_INCREMENT NOT NULL, total INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE post_like3 ADD CONSTRAINT FK_A80D8302950BB67A FOREIGN KEY (post_share_id) REFERENCES post_share (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE post_like3 ADD CONSTRAINT FK_A80D8302A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE post_like2 ADD CONSTRAINT FK_DF0AB394950BB67A FOREIGN KEY (post_share_id) REFERENCES post_share (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
