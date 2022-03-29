<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329015807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_52EA1F094584665A');
        $this->addSql('DROP INDEX IDX_52EA1F09E238517C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_item AS SELECT id, product_id, order_ref_id, quantity FROM order_item');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('CREATE TABLE order_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL, order_ref_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_52EA1F09E238517C FOREIGN KEY (order_ref_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_item (id, product_id, order_ref_id, quantity) SELECT id, product_id, order_ref_id, quantity FROM __temp__order_item');
        $this->addSql('DROP TABLE __temp__order_item');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09E238517C ON order_item (order_ref_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_52EA1F094584665A');
        $this->addSql('DROP INDEX IDX_52EA1F09E238517C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_item AS SELECT id, product_id, order_ref_id, quantity FROM order_item');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('CREATE TABLE order_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL, order_ref_id INTEGER NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO order_item (id, product_id, order_ref_id, quantity) SELECT id, product_id, order_ref_id, quantity FROM __temp__order_item');
        $this->addSql('DROP TABLE __temp__order_item');
        $this->addSql('CREATE INDEX IDX_52EA1F094584665A ON order_item (product_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09E238517C ON order_item (order_ref_id)');
    }
}
