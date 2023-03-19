<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230319113202 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE assets (id BIGSERIAL NOT NULL, user_id BIGINT NOT NULL, uuid UUID NOT NULL DEFAULT uuid_generate_v4(), label VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT Now(), updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT Now(), PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX assets_user_id_idx ON assets (user_id)');
        $this->addSql('CREATE UNIQUE INDEX assets_uuid_unique_idx ON assets (uuid)');
        $this->addSql('CREATE TABLE users (id BIGSERIAL NOT NULL, uuid UUID NOT NULL DEFAULT uuid_generate_v4(), email VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT Now(), updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT Now(), PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX users_email_unique_idx ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX users_uuid_unique_idx ON users (uuid)');
        $this->addSql('ALTER TABLE assets ADD CONSTRAINT FK_79D17D8EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assets DROP CONSTRAINT FK_79D17D8EA76ED395');
        $this->addSql('DROP TABLE assets');
        $this->addSql('DROP TABLE users');
    }
}
