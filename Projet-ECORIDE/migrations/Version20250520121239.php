<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250520121239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE car ADD CONSTRAINT FK_773DE69D46F9C2E5 FOREIGN KEY (car_user) REFERENCES `user` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3F97C8F FOREIGN KEY (car_brand) REFERENCES car_brand (carBrand_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey ADD journey_driver INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2C1313B4E FOREIGN KEY (journey_car) REFERENCES car (car_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2A389007F FOREIGN KEY (journey_driver) REFERENCES `user` (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C816C6A2A389007F ON journey (journey_driver)
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
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE user_photo user_photo VARCHAR(200) DEFAULT NULL
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
            DROP INDEX IDX_C816C6A2A389007F ON journey
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE journey DROP journey_driver
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
            ALTER TABLE `user` CHANGE user_photo user_photo VARCHAR(100) DEFAULT NULL
        SQL);
    }
}
