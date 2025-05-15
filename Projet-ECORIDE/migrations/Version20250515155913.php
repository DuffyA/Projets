<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515155913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE car (car_id INT AUTO_INCREMENT NOT NULL, car_model VARCHAR(50) DEFAULT NULL, car_registration VARCHAR(50) NOT NULL, car_energy TINYINT(1) DEFAULT 0 NOT NULL, car_color VARCHAR(50) DEFAULT NULL, car_first_registration_date DATE NOT NULL, PRIMARY KEY(car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE car_brand (car_brand_id INT AUTO_INCREMENT NOT NULL, car_brand_label VARCHAR(50) NOT NULL, PRIMARY KEY(car_brand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE review (review_id INT AUTO_INCREMENT NOT NULL, review_comment VARCHAR(255) DEFAULT NULL, review_note INT NOT NULL, review_status TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(review_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE car
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_brand
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE review
        SQL);
    }
}
