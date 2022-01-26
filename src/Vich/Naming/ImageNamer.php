<?php

namespace App\Vich\Naming;

use App\Entity\User;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Vich\UploaderBundle\Exception\NameGenerationException;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Naming\Polyfill\FileExtensionTrait;

class ImageNamer implements NamerInterface
{
    use FileExtensionTrait;

    /**
     * @var User
     */
    private $user;

    public function name($object, PropertyMapping $mapping): string
    {

        $file = $mapping->getFile($object);

        try {
            $firstname = $this->getPropertyValue($object, "firstname");
            $lastname = $this->getPropertyValue($object, "lastname");
            $name = $firstname . "-" . $lastname;
        } catch (NoSuchPropertyException $e) {
            throw new NameGenerationException(\sprintf('File name could not be generated'));
        }

        if (empty($name)) {
            throw new NameGenerationException(\sprintf('File name could not be generated: property %s is empty.', $this->propertyPath));
        }

        // append the file extension if there is one
        if ($extension = $this->getExtension($file)) {
            $name = \sprintf('%s.%s', $name, $extension);
        }

        return $name;
    }

    private function getPropertyValue($object, $propertyPath)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        return $accessor->getValue($object, $propertyPath);
    }
}