<?php namespace Eloquent;

use BaseTestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\Expression;
use Mockery as m;
use Locaravel\Eloquent\Builder;
use Locaravel\Eloquent\PostgisTrait;
use Locaravel\Geometries\LineString;
use Locaravel\Geometries\Point;
use Locaravel\Geometries\Polygon;

class BuilderTest extends BaseTestCase
{
    protected $builder;

    /**
     * @var \Mockery\MockInterface $queryBuilder
     */
    protected $queryBuilder;

    protected function setUp(): void
    {
        $this->queryBuilder = m::mock(QueryBuilder::class);
        $this->queryBuilder->makePartial();

        $this->queryBuilder
          ->shouldReceive('from')
          ->andReturn($this->queryBuilder);

        $this->queryBuilder
          ->shouldReceive('take')
          ->with(1)
          ->andReturn($this->queryBuilder);

        $this->queryBuilder
          ->shouldReceive('get')
          ->andReturn([]);

        $this->builder = new Builder($this->queryBuilder);
        $this->builder->setModel(new TestBuilderModel());
    }

    public function testUpdate()
    {
        $this->queryBuilder
          ->shouldReceive('raw')
          ->with("public.ST_GeogFromText('POINT(2 1)')")
          ->andReturn(new Expression("public.ST_GeogFromText('POINT(2 1)')"));

        $this->queryBuilder
          ->shouldReceive('update')
          ->andReturn(1);

        $builder = m::mock(Builder::class, [$this->queryBuilder])->makePartial();
        $builder->shouldAllowMockingProtectedMethods();
        $builder
          ->shouldReceive('addUpdatedAtColumn')
          ->andReturn(['point' => new Point(1, 2)]);

        $builder->update(['point' => new Point(1, 2)]);
    }

    public function testUpdateLinestring()
    {
        $this->queryBuilder
          ->shouldReceive('raw')
          ->with("public.ST_GeogFromText('LINESTRING(0 0, 1 1, 2 2)')")
          ->andReturn(new Expression("public.ST_GeogFromText('LINESTRING(0 0, 1 1, 2 2)')"));

        $this->queryBuilder
          ->shouldReceive('update')
          ->andReturn(1);

        $linestring = new LineString([new Point(0, 0), new Point(1, 1), new Point(2, 2)]);

        $builder = m::mock(Builder::class, [$this->queryBuilder])->makePartial();
        $builder->shouldAllowMockingProtectedMethods();
        $builder
          ->shouldReceive('addUpdatedAtColumn')
          ->andReturn(['linestring' => $linestring]);

        $builder
          ->shouldReceive('asWKT')->with($linestring)->once();

        $builder->update(['linestring' => $linestring]);
    }
}

class TestBuilderModel extends Model
{
    use PostgisTrait;

    protected $postgisFields = [
      'point'      => Point::class,
      'linestring' => LineString::class,
      'polygon'    => Polygon::class
    ];
}
