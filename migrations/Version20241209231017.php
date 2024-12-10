<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209231017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE libro (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titulo VARCHAR(50) NOT NULL, autor VARCHAR(50) NOT NULL, genero VARCHAR(50) NOT NULL, ano_publicacion VARCHAR(10) NOT NULL)');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, edad INTEGER NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE libro');
        $this->addSql('DROP TABLE usuario');
    }
}
