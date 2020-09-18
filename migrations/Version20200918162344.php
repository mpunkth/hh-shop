<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918162344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, order_id INT NOT NULL, ordered_product_ids TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "order".ordered_product_ids IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE base_data ADD surname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD street VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD birthday DATE NOT NULL');
        $this->addSql('ALTER TABLE base_data DROP vorname');
        $this->addSql('ALTER TABLE base_data DROP hausnummer');
        $this->addSql('ALTER TABLE base_data DROP ort');
        $this->addSql('ALTER TABLE base_data DROP strasse');
        $this->addSql('ALTER TABLE base_data RENAME COLUMN plz TO postcode');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('ALTER TABLE base_data ADD vorname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD hausnummer VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD ort VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data ADD strasse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE base_data DROP surname');
        $this->addSql('ALTER TABLE base_data DROP city');
        $this->addSql('ALTER TABLE base_data DROP street');
        $this->addSql('ALTER TABLE base_data DROP email');
        $this->addSql('ALTER TABLE base_data DROP birthday');
        $this->addSql('ALTER TABLE base_data RENAME COLUMN postcode TO plz');
    }
}
