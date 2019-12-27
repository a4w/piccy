<?php


namespace Model;


class Country
{
    private $countryID;
    private $countryName;

    public function __construct($countryID, $countryName)
    {
        $this->countryID = $countryID;
        $this->countryName = $countryName;
    }

    public function getCountryID()
    {
        return $this->countryID;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }

}