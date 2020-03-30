<?php
namespace Harbitue\Tests;

use Harbitue\Habitue;
use PHPUnit\Framework\TestCase;
use Harbitue\Integration\Response;
use Harbitue\Integration\Collector;
use Harbitue\Tests\Helpers\GuzzleMocker;
use Harbitue\Contracts\HarbitueInterface;
use Tightenco\Collect\Support\Collection;

class HabitueTest extends TestCase
{
    private Habitue $harbitue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->harbitue = new Habitue(GuzzleMocker::prepareGuzzleMock());
    }

    public function testMake()
    {
        $habitue = Habitue::make();

        $this->assertInstanceOf(HarbitueInterface::class, $habitue);
    }

    public function testPostSuccess()
    {
        $response = $this->harbitue->post('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }

    public function testGetSuccess()
    {
        $response = $this->harbitue->get('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(Collector::class, $response->collect());
        $this->assertInstanceOf(Collection::class, $response->collect());

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }
}
