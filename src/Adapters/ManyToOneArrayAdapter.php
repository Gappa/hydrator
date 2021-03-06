<?php declare(strict_types = 1);

namespace Nettrine\Hydrator\Adapters;

use Doctrine\ORM\EntityManagerInterface;
use Nettrine\Hydrator\Arguments\ArrayArgs;
use Nettrine\Hydrator\IPropertyAccessor;

class ManyToOneArrayAdapter implements IArrayAdapter
{

	/** @var EntityManagerInterface */
	private $em;

	/** @var IPropertyAccessor */
	private $propertyAccessor;

	public function __construct(EntityManagerInterface $em, IPropertyAccessor $propertyAccessor)
	{
		$this->em = $em;
		$this->propertyAccessor = $propertyAccessor;
	}

	public function isWorkable(ArrayArgs $args): bool
	{
		return $args->metadata->isManyToOne($args->field);
	}

	public function work(ArrayArgs $args): void
	{
		if (is_object($args->value)) {
			$metadata = $this->em->getClassMetadata($args->metadata->getAssociationTargetClass($args->field));
			$id = $metadata->getIdentifier()[0];

			$args->setValue($this->propertyAccessor->get($args->value, $id));
		}
	}

}
