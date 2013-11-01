<?php

namespace Jfx\UserPreferencesBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;

class EntityTransformer implements DataTransformerInterface
{

    /**
     * @var ObjectManager
     */
    private $om;
    private $entityName;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, $entityName)
    {
        $this->om = $om;
        $this->entityName = $entityName;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Array|null $ids
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function transform($ids)
    {
        if (!$ids) {
            return null;
        }

        $object = $this->om
                ->getRepository($this->entityName)
                ->findBy(array('id' => $ids));

        if (0 === count($object)) {
            return null;
        }
        return new \Doctrine\Common\Collections\ArrayCollection($object);
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($object)
    {
        $ret = [];

        if (null === $object) {
            return $ret;
        }
        foreach ($object as $item) {
            $ret[] = $item->getId();
        }
        return $ret;
    }

}
