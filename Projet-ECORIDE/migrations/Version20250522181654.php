<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522181654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE car (car_id INT AUTO_INCREMENT NOT NULL, car_user INT NOT NULL, car_brand INT NOT NULL, car_model VARCHAR(50) DEFAULT NULL, car_registration VARCHAR(50) NOT NULL, car_energy TINYINT(1) DEFAULT 0 NOT NULL, car_color VARCHAR(50) DEFAULT NULL, car_first_registration_date DATE NOT NULL, INDEX IDX_773DE69D46F9C2E5 (car_user), INDEX IDX_773DE69DC3F97C8F (car_brand), PRIMARY KEY(car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE car_brand (car_brand_id INT AUTO_INCREMENT NOT NULL, car_brand_label VARCHAR(50) NOT NULL, PRIMARY KEY(car_brand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE journey (journey_id INT AUTO_INCREMENT NOT NULL, journey_car INT NOT NULL, journey_driver INT NOT NULL, journey_departure_date DATE NOT NULL, journey_departure_time TIME NOT NULL, journey_departure_place VARCHAR(50) NOT NULL, journey_arrival_date DATE NOT NULL, journey_arrival_time TIME NOT NULL, journey_arrival_place VARCHAR(50) NOT NULL, journey_status VARCHAR(50) NOT NULL, journey_seats INT NOT NULL, journey_price DOUBLE PRECISION NOT NULL, INDEX IDX_C816C6A2C1313B4E (journey_car), INDEX IDX_C816C6A2A389007F (journey_driver), PRIMARY KEY(journey_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE review (review_id INT AUTO_INCREMENT NOT NULL, review_writer INT NOT NULL, review_target INT NOT NULL, review_journey INT NOT NULL, review_comment VARCHAR(255) DEFAULT NULL, review_note INT NOT NULL, review_status TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_794381C61DD69F42 (review_writer), INDEX IDX_794381C6CC19683C (review_target), INDEX IDX_794381C653F87255 (review_journey), PRIMARY KEY(review_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (user_id INT AUTO_INCREMENT NOT NULL, user_email VARCHAR(180) NOT NULL, user_roles JSON NOT NULL COMMENT '(DC2Type:json)', user_password VARCHAR(255) NOT NULL, user_firstname VARCHAR(50) DEFAULT NULL, user_surname VARCHAR(50) DEFAULT NULL, user_phone VARCHAR(15) DEFAULT NULL, user_address VARCHAR(200) DEFAULT NULL, user_birthdate DATE DEFAULT NULL, user_photo VARCHAR(200) DEFAULT NULL, user_pseudo VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (user_email), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car ADD CONSTRAINT FK_773DE69D46F9C2E5 FOREIGN KEY (car_user) REFERENCES `user` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3F97C8F FOREIGN KEY (car_brand) REFERENCES car_brand (carBrand_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2C1313B4E FOREIGN KEY (journey_car) REFERENCES car (car_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2A389007F FOREIGN KEY (journey_driver) REFERENCES `user` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C61DD69F42 FOREIGN KEY (review_writer) REFERENCES `user` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C6CC19683C FOREIGN KEY (review_target) REFERENCES `user` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C653F87255 FOREIGN KEY (review_journey) REFERENCES journey (journey_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE car DROP FOREIGN KEY FK_773DE69D46F9C2E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC3F97C8F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2C1313B4E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2A389007F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C61DD69F42
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C6CC19683C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C653F87255
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_brand
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE journey
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
