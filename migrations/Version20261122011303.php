<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261122011303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE VIEW vw_books_by_authors AS SELECT a.id, a.name AS author_name, COUNT(DISTINCT ba.book_id) AS total_books FROM authors a JOIN book_author ba ON ba.author_id = a.id GROUP BY a.id");
        $this->addSql("CREATE VIEW vw_books_by_subjects AS SELECT s.id, s.description AS subject_name, COUNT(DISTINCT bs.book_id) AS total_books FROM subjects s JOIN book_subject bs ON bs.subject_id = s.id GROUP BY s.id");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP VIEW vw_books_by_authors");
        $this->addSql("DROP VIEW vw_books_by_subjects");
    }
}
