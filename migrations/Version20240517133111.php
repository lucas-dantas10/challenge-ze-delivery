<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517133111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA tokens');
        $this->addSql('CREATE SCHEMA partners');
        $this->addSql('CREATE SCHEMA users');
        $this->addSql('CREATE SEQUENCE tokens.s_access_tokens_nu_seq_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partners.s_partner_nu_seq_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users.s_user_nu_seq_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tokens.s_access_tokens (nu_seq_id INT NOT NULL, nu_seq_user INT DEFAULT NULL, des_name VARCHAR(255) NOT NULL, des_token VARCHAR(255) NOT NULL, dt_expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, dt_created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, dt_updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(nu_seq_id))');
        $this->addSql('CREATE INDEX IDX_B78C8D39F915B6B3 ON tokens.s_access_tokens (nu_seq_user)');
        $this->addSql('CREATE TABLE partners.s_partner (nu_seq_id INT NOT NULL, des_trading_name VARCHAR(255) NOT NULL, des_owner_name VARCHAR(255) NOT NULL, des_document VARCHAR(255) NOT NULL, mp_coverage_area Geometry(MultiPolygon) NOT NULL, pt_address Geometry(Point) NOT NULL, dt_created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, dt_updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(nu_seq_id))');
        $this->addSql('CREATE UNIQUE INDEX document_key ON partners.s_partner (des_document)');
        $this->addSql('COMMENT ON COLUMN partners.s_partner.mp_coverage_area IS \'(DC2Type:multipolygon)\'');
        $this->addSql('COMMENT ON COLUMN partners.s_partner.pt_address IS \'(DC2Type:point)\'');
        $this->addSql('CREATE TABLE users.s_user (nu_seq_id INT NOT NULL, des_name VARCHAR(255) NOT NULL, des_email VARCHAR(255) NOT NULL, des_password VARCHAR(255) NOT NULL, pt_address Geometry(Point) NOT NULL, dt_created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, dt_updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(nu_seq_id))');
        $this->addSql('CREATE UNIQUE INDEX email_key ON users.s_user (des_email)');
        $this->addSql('COMMENT ON COLUMN users.s_user.pt_address IS \'(DC2Type:point)\'');
        $this->addSql('ALTER TABLE tokens.s_access_tokens ADD CONSTRAINT FK_B78C8D39F915B6B3 FOREIGN KEY (nu_seq_user) REFERENCES users.s_user (nu_seq_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tokens.s_access_tokens_nu_seq_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partners.s_partner_nu_seq_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users.s_user_nu_seq_id_seq CASCADE');
        $this->addSql('ALTER TABLE tokens.s_access_tokens DROP CONSTRAINT FK_B78C8D39F915B6B3');
        $this->addSql('DROP TABLE tokens.s_access_tokens');
        $this->addSql('DROP TABLE partners.s_partner');
        $this->addSql('DROP TABLE users.s_user');
    }
}
