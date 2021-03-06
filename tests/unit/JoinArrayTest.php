<?php

use Nettrine\Hydrator\Adapters\JoinArrayAdapter;
use Nettrine\Hydrator\Factories\MetadataFactory;
use Nettrine\Hydrator\Hydrator;
use Nettrine\Hydrator\PropertyAccessor;

class JoinArrayTest extends \Codeception\Test\Unit
{

	/**
	 * @var \UnitTester
	 */
	protected $tester;

	/**
	 * @var Hydrator
	 */
	protected $hydrator;

	protected function _before()
	{
		$em = $this->getModule('\Helper\Unit')->createEntityManager();
		$this->hydrator = new Hydrator(new MetadataFactory($em));
		$this->hydrator->addArrayAdapter(new JoinArrayAdapter(new PropertyAccessor()));
	}

	protected function _after()
	{
	}

	// tests
	public function testSomeFeature()
	{
		$simple = new Simple('foo', 'bar');
		$simple->setId(1);
		$manyToOne = new ManyToOne($simple);

		$array = $this->hydrator->toArray($manyToOne, [
			'joins' => [
				'simple' => 'name',
			],
		]);

		$this->assertSame([
			'id' => null,
			'simple' => 'foo',
		], $array);
	}

}