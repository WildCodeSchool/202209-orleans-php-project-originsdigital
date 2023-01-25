<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125151242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_video_likes DROP FOREIGN KEY FK_6FB38E4A29C1004E');
        $this->addSql('ALTER TABLE user_video_likes DROP FOREIGN KEY FK_6FB38E4AA76ED395');
        $this->addSql('DROP TABLE user_video_likes');
        $this->addSql('ALTER TABLE sponsor CHANGE logo logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_video_likes (video_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6FB38E4AA76ED395 (user_id), INDEX IDX_6FB38E4A29C1004E (video_id), PRIMARY KEY(video_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_video_likes ADD CONSTRAINT FK_6FB38E4A29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_likes ADD CONSTRAINT FK_6FB38E4AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsor CHANGE logo logo VARCHAR(255) NOT NULL');
    }
}
