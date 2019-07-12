<?php
namespace RobinTheHood\VirtualHostManager;

class VirtualHost
{
    public $id;
    public $localHost;
    public $remoteHost;
    public $description;
    public $documentsRootPath;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLocalHost($localHost)
    {
        $this->localHost = $localHost;
    }

    public function setRemoteHost($remoteHost)
    {
        $this->remoteHost = $remoteHost;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setDocumentsRootPath($documentsRootPath)
    {
        $this->documentsRootPath = $documentsRootPath;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLocalHost()
    {
        return $this->localHost;
    }

    public function getRemoteHost()
    {
        return $this->remoteHost;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDocumentsRootPath()
    {
        return $this->documentsRootPath;
    }

    public function documentsRootExists()
    {
        return is_dir($this->documentsRootPath);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'localHost' => $this->localHost,
            'remoteHost' => $this->remoteHost,
            'description' => $this->description,
            'documentsRootPath' => $this->documentsRootPath
        ];
    }

    public function loadFromArray($array)
    {
        $this->setId($array['id']);
        $this->setLocalHost($array['localHost']);
        $this->setRemoteHost($array['remoteHost']);
        $this->setDescription($array['description']);
        $this->setDocumentsRootPath($array['documentsRootPath']);
    }
}
