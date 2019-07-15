<?php

class APITest extends TestCase
{

    public function testMusic()
    {
         $this->get('/api/music')->seeJsonStructure(['id', 'name', 'music', 'image']);
    }

    public function testMusicId()
    {
        $testjson = ['id' => '1', 'name' => 'testname1', 'music' => 'testmusic1', 'image' => 'testimage1'];

        $response = $this->call('GET', '/api/music', $testjson);

        $this->assertEquals(
            json_encode($testjson), $response->getContent()
        );
    }

    public function testCount()
    {
         $this->get('/api/count')
              ->seeJsonEquals([
                'count' => '2',
              ]);
    }

    public function testSearch()
    {
        $testjson = [['id' => 2, 'name' => 'testname2', 'music' => 'testmusic2', 'image' => 'testimage2']];

        $response = $this->call('GET', '/api/search', ['name' => 'testname2']);

        $this->assertEquals(
            json_encode($testjson), $response->getContent()
        );
    }

}