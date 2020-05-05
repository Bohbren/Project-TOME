<?php

class Workitem {
    
    private $workItemID;
    private $itemName;
    private $hours;
    private $itemDescription;
    private $claimedByUser;
    private $lastModifiedOn;
    private $itemStatus;
    private $priority;
    
    public function __construct($workItemID, $itemDescription, $claimedByUser, $lastModifiedOn, $itemStatus, $priority, $hours) {
        $this->workItemID = $workItemID;
        $this->claimedByUser = $claimedByUser;
        $this->itemDescription = $itemDescription;
        $this->lastModifiedOn = $lastModifiedOn;
        $this->itemStatus = $itemStatus;
        $this->priority = $priority;
        $this->hours = $hours;
    }
    
    function getHours() {
        return $this->hours;
    }

    function setHours($hours) {
        $this->hours = $hours;
    }

        
    function getWorkItemID() {
        return $this->workItemID;
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
    
    function getPriority() {
        return $this->priority;
    }

    function setPriority($priority) {
        $this->priority = $priority;
    }


    
}