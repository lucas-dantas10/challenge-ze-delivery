<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424201528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE s_partner (nu_seq_id INT AUTO_INCREMENT NOT NULL, des_trading_name VARCHAR(255) NOT NULL, des_owner_name VARCHAR(255) NOT NULL, des_document VARCHAR(255) NOT NULL, geo_coverage_area MULTIPOLYGON NOT NULL COMMENT \'(DC2Type:multipolygon)\', geo_address POINT NOT NULL COMMENT \'(DC2Type:point)\', PRIMARY KEY(nu_seq_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE s_partner');
    }
}
