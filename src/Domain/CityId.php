<?php
namespace Codium\CleanCode\Domain;


final class CityId
{
    private $value;

    /**
     * ClientId constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }


}