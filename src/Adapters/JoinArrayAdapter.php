<?php declare(strict_types = 1);

namespace Nettrine\DoctrineHydration\Adapters;

use Nettrine\DoctrineHydration\Arguments\ArrayArgs;
use Nettrine\DoctrineHydration\IPropertyAccessor;

class JoinArrayAdapter implements IArrayAdapter
{

	/** @var IPropertyAccessor */
	private $propertyAccessor;

	public function __construct(IPropertyAccessor $propertyAccessor)
	{
		$this->propertyAccessor = $propertyAccessor;
	}

	public function isWorkable(ArrayArgs $args): bool
	{
		return $args->hasSettingsSection('joins');
	}

	public function work(ArrayArgs $args): void
	{
		if (is_object($args->value)) {
			$args->setValue($this->propertyAccessor->get($args->value, $args->getSettingsSection('joins')));
		}
	}

}
