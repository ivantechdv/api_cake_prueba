<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonasTable Test Case
 */
class PersonasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonasTable
     */
    protected $Personas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Personas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Personas') ? [] : ['className' => PersonasTable::class];
        $this->Personas = $this->getTableLocator()->get('Personas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Personas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PersonasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
