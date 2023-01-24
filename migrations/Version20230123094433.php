<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230123094433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video DROP picture, CHANGE video video VARCHAR(255) DEFAULT NULL, CHANGE video_link thumbnail_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE thumbnail_name thumbnail VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE thumbnail picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video ADD picture VARCHAR(255) NOT NULL, CHANGE video video VARCHAR(255) NOT NULL, CHANGE thumbnail_name video_link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE thumbnail thumbnail_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE picture thumbnail VARCHAR(255) DEFAULT NULL');
    }
}
