<?php

namespace Nspyke\Select2EntityBundle\Form\DataTransformer;

use Doctrine\Persistence\ObjectManager;
use Nspyke\Select2EntityBundle\Form\TestEntity;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EntitiesToPropertyTransformerTest extends TestCase
{
    private MockObject $objectManagerMock;
    private EntitiesToPropertyTransformer $transformer;

    protected function setUp(): void
    {
        $this->objectManagerMock = $this->createMock(ObjectManager::class);

        $this->transformer = new EntitiesToPropertyTransformer(
            $this->objectManagerMock,
            TestEntity::class,
            primaryKey: 'id',
        );
    }

    public function testTransformsEntitiesToArray(): void
    {
        $result = $this->transformer->transform([
            new TestEntity(id: 1, name: 'Test Entity 1'),
            new TestEntity(id: 2, name: 'Test Entity 2'),
            new TestEntity(id: 3, name: 'Test Entity 3'),
        ]);
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }
}
