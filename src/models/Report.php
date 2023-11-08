<?php

class Report
{
    private $title;
    private $description;
    private $image;
    private $latitude;
    private $longitude;
    private $type;
    private $date;
    private $contact;

    public function __construct($title, $description, $image, $latitude, $longitude, $type, $date, $contact)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->type = $type;
        $this->date = $date;
        $this->contact = $contact;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact($contact): void
    {
        $this->contact = $contact;
    }

    public function getTypeString (): ?string {
        switch ($this->type) {
            case 'photo':
                return "Typ zgłoszenia: zdjęcie / relacja";
            case 'weather':
                return "Typ zgłoszenia: warunki pogodowe";
            case 'exclamation':
                return "Typ zgłoszenia: ostrzeżenie - ogólne";
            case 'closed':
                return "Typ zgłoszenia: zamknięcie szlaku / drogi";
            case 'signpost':
                return "Typ zgłoszenia: ostrzeżenie - znakowanie szlaku";
            case 'path':
                return "Typ zgłoszenia: ostzeżenie - stan nawierzchni";
            case 'animals':
                return "Typ zgłoszenia: ostrzeżenie - dzikie zwierzęta";
            case 'accident':
                return "Typ zgłoszenia: ostrzeżenie - wypadek z udziałem ludzi";
        }
        return null;
    }
}