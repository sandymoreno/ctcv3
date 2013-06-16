<?php

namespace Ctc\AppBundle\Form\DataTransformers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class NodeToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }
    /**
     * Transforms an object (issue) to a string (number).
     * @param Issue|null $issue
     * @return string
     */
    public function reverseTransform($node)
    {
        if (null === $node) {
            return "";
        }
        return $node->getId();
    }
    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param string $number
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function transform($number)
    {
//        if (!$number) {
//            return null;
//        }
        $node = $this->om
            ->getRepository('CtcAppBundle:Common\Destination')
            ->findOneBy(array('id' =>49))
        ;
        if (null === $node) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $number
            ));
        }
        return $node;
    }

}