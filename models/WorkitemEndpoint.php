<?php

require_once 'Workitem.php';
require_once 'database.php';

class WorkitemEndpoint {
    
    public static function getWorkItems() {
        $workitems = array();
        $query = "SELECT * FROM workitem";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $wi) {
            $item = new WorkItem($wi["workItemID"], $wi["itemDescription"], $wi["claimedByUser"], $wi["lastModifiedOn"], $wi["itemStatus"], $wi["itemPriority"], $wi["itemHours"], $wi["itemName"]);
            array_push($workitems, $item);
        }
        $stmt->closeCursor();
        return $workitems;
    }
    
    public static function addWorkItem($item) {
        $query = "INSERT INTO workitem(itemDescription, claimedByUser, lastModifiedOn, itemStatus, itemPriority, itemHours, itemName) VALUES (:itemdesc, :claimedby, :modifiedon, :status, :priority, :hours, :name)";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(":itemdesc", $item->getItemDescription());
        $stmt->bindValue(":claimedby", $item->getClaimedByUser());
        $stmt->bindValue(":modifiedon", $item->getLastModifiedOn());
        $stmt->bindValue(":status", $item->getItemStatus());
        $stmt->bindValue(":priority", $item->getPriority());
        $stmt->bindValue(":hours", $item->getHours());
        $stmt->bindValue(":name", $item->getItemName());
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public static function updateWorkItem($item) {
        $query = "UPDATE workitem SET itemDescription = :desc, itemPriority = :priority, claimedByUser = :claimedby, itemName = :name, itemHours = :hours, itemStatus = :status WHERE workItemID = :id";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(":desc", $item->getItemDescription());
        $stmt->bindValue(":claimedby", $item->getClaimedByUser());
        $stmt->bindValue(":priority", $item->getPriority());
        $stmt->bindValue(":id", intval($item->getWorkItemID()));
        $stmt->bindValue(":name", $item->getItemName());
        $stmt->bindValue(":hours", $item->getHours());
        $stmt->bindValue(":status", $item->getItemStatus());
        $stmt->execute();
        $stmt->closeCursor();
    }
    
}
