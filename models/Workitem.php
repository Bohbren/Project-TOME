<?php

class Workitem {
    
    private $workItemID;
    private $itemName;
    private $itemDescription;
    private $claimedByUser;
    private $lastModifiedOn;
    private $itemStatus;
    
    public function __construct($workItemID, $itemName, $itemDescription, $claimedByUser, $lastModifiedOn, $itemStatus) {
        $this->workItemID = $workItemID;
        $this->claimedByUser = $claimedByUser;
        $this->itemDescription = $itemDescription;
        $this->itemName = $itemName;
        $this->lastModifiedOn = $lastModifiedOn;
        $this->itemStatus = $itemStatus;
    }
    
    function getWorkItemID() {
        return $this->workItemID;
    }

    function getItemName() {
        return $this->itemName;
    }

    function getItemDescription() {
        return $this->itemDescription;
    }

    function getClaimedByUser() {
        return $this->claimedByUser;
    }

    function getLastModifiedOn() {
        return $this->lastModifiedOn;
    }

    function getItemStatus() {
        return $this->itemStatus;
    }

    function setWorkItemID($workItemID) {
        $this->workItemID = $workItemID;
    }

    function setItemName($itemName) {
        $this->itemName = $itemName;
    }

    function setItemDescription($itemDescription) {
        $this->itemDescription = $itemDescription;
    }

    function setClaimedByUser($claimedByUser) {
        $this->claimedByUser = $claimedByUser;
    }

    function setLastModifiedOn($lastModifiedOn) {
        $this->lastModifiedOn = $lastModifiedOn;
    }

    function setItemStatus($itemStatus) {
        $this->itemStatus = $itemStatus;
    }
    
}