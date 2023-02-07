<?php

namespace Libs\Database;

use PDOException;

class ContactsTable
{
   private $db = null;

   public function __construct(MySQL $db)
   {
      $this->db = $db->connect();
   }

   public function insert($data)
   {
      try {
         $query = "
            INSERT INTO contacts(
                name,email,phone,address,photo,created_at,updated_at,user_id)
                VALUES (:name,:email,:phone,:address,:photo,:created_at,:updated_at,:user_id)
            ";

         $statement = $this->db->prepare($query);
         $statement->execute($data);

         return $this->db->lastInsertId();
      } catch (PDOException $e) {
         return $e->getMessage();
      }
   }

   public function update($data, $id)
   {
      $statement = $this->db->prepare(
         "UPDATE contacts SET
         name=:name,email=:email,phone=:phone,address=:address,photo=:photo,created_at=:created_at,updated_at=:updated_at,user_id=:user_id WHERE id=:id"
      );
      $statement->execute([...$data, "id" => $id]);

      return $statement->rowCount();
   }

   public function get($id)
   {
      $statement = $this->db->prepare(
         "SELECT * FROM contacts WHERE id=:id"
      );

      $statement->execute([
         ':id' => $id,
      ]);

      $row = $statement->fetch();

      return $row ?? false;
   }

   public function getAll()
   {
      $statement = $this->db->query("
            SELECT *
            FROM contacts
        ");

      return $statement->fetchAll();
   }

   public function delete($id)
   {
      $statement = $this->db->prepare("
            DELETE FROM contacts WHERE id = :id
        ");

      $statement->execute([':id' => $id]);

      return $statement->rowCount();
   }
}
