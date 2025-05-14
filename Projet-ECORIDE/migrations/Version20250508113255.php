<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508113255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD user_firstname VARCHAR(50) DEFAULT NULL, ADD user_surname VARCHAR(50) DEFAULT NULL, ADD user_phone VARCHAR(15) DEFAULT NULL, ADD user_address VARCHAR(200) DEFAULT NULL, ADD user_birthdate DATE DEFAULT NULL, ADD user_photo LONGBLOB DEFAULT NULL, ADD user_pseudo VARCHAR(50) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `user` DROP user_firstname, DROP user_surname, DROP user_phone, DROP user_address, DROP user_birthdate, DROP user_photo, DROP user_pseudo
        SQL);
    }
}
