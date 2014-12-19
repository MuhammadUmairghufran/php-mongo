<?php

namespace Sokil\Mongo;

/**
 * @link http://docs.mongodb.org/manual/core/2dsphere/
 */
class DocumentGeoTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \Sokil\Mongo\Collection
     */
    private $collection;

    public function setUp()
    {
        $client = new Client();
        $database = $client->getDatabase('test');
        $this->collection = $database
            ->getCollection('phpmongo_test_collection')
            ->delete();
    }

    public function tearDown()
    {
        $this->collection->delete();
    }

    public function testSetPoint()
    {
        $documentId = $this->collection
            ->createDocument()
            ->setPoint('location', 30.523400000000038, 50.4501)
            ->save()
            ->getId();

        $this->assertEquals(
            array(
                'type' => 'Point',
                'coordinates' => array(30.523400000000038, 50.4501)
            ),
            $this->collection->getDocument($documentId)->get('location')
        );
    }

    public function testLineString()
    {
        $documentId = $this->collection
            ->createDocument()
            ->setLineString('location', array(
                array(30.523400000000038, 50.4501),
                array(24.012228, 49.831485),
                array(36.230376, 49.993499),
            ))
            ->save()
            ->getId();

        $this->assertEquals(
            array(
                'type' => 'LineString',
                'coordinates' => array(
                    array(30.523400000000038, 50.4501),
                    array(24.012228, 49.831485),
                    array(36.230376, 49.993499),
                )
            ),
            $this->collection->getDocument($documentId)->get('location')
        );
    }

    public function testPolygon()
    {

    }

    public function testMultiPoint()
    {

    }

    public function testMultiLineString()
    {

    }

    public function testMultiPolygon()
    {

    }

    public function testGeometryCollection()
    {

    }
}