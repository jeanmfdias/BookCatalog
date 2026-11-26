<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261122165255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE VIEW vw_books_all_details AS
            SELECT b.id, b.title, b.publisher, b.edition, b.published_year, b.price, STRING_AGG(DISTINCT a.name, ', ' ORDER BY a.name ASC) AS authors, STRING_AGG(DISTINCT s.description, ', ' ORDER BY s.description ASC) AS subjects
            FROM books b
            INNER JOIN book_author ba ON ba.book_id = b.id
            INNER JOIN authors a ON a.id = ba.author_id
            LEFT JOIN book_subject bs ON bs.book_id = b.id
            LEFT JOIN subjects s ON s.id = bs.subject_id
            GROUP BY b.id");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
