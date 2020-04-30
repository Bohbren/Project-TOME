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
            $item = new WorkItem($wi["workItemID"], $wi["itemName"], $wi["itemDescription"], $wi["claimedByUser"], $wi["lastModifiedOn"], $wi["itemStatus"]);
            array_push($workitems, $item);
        }
        $stmt->closeCursor();
        return $workitems;
    }
    
    public static function addWorkItem($item) {
        $query = "INSERT INTO workitem(itemName, itemDescription, claimedByUser, lastModifiedOn, itemStatus) VALUES (:itemname, :itemdesc, :claimedby, :modifiedon, :status)";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(":itemname", $item->getItemName());
        $stmt->bindValue(":itemdesc", $item->getItemDescription());
        $stmt->bindValue(":claimedby", $item->getClaimedByUser());
        $stmt->bindValue(":modifiedon", $item->getLastModifiedOn());
        $stmt->bindValue(":status", $item->getItemStatus());
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public static function updateWorkItem($item) {
        $query = "UPDATE workitem SET itemDescription = :desc, itemPriority = :priority, claimedByUser = :claimedby WHERE workItemID = :id";
        $db = Database::getDB();
        $stmt = $db->prepare($query);
        $stmt->bindValue(":desc", $item->getItemDescription());
        $stmt->bindValue(":claimedby", $item->getClaimedByUser());
        $stmt->bindValue(":priority", $item->getPriority());
        $stmt->bindValue(":id", $item->getWorkItemID());
        $stmt->execute();
        $stmt->closeCursor();
    }
    
}
