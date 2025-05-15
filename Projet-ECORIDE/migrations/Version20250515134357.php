<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515134357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE journey (journey_id INT AUTO_INCREMENT NOT NULL, journey_departure_date DATE NOT NULL, journey_departure_time TIME NOT NULL, journey_departure_place VARCHAR(50) NOT NULL, journey_arrival_date DATE NOT NULL, journey_arrival_time TIME NOT NULL, journey_arrival_place VARCHAR(50) NOT NULL, journey_status VARCHAR(50) NOT NULL, journey_seats INT NOT NULL, journey_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(journey_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE journey
        SQL);
    }
}
