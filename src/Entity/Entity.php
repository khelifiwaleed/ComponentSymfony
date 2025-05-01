<?php
declare(strict_types=1);

namespace App\Entity;

use App\Traits\EntityRepeatedInput;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class Entity
{
    use EntityRepeatedInput;
}