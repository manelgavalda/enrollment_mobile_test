<?php

/**
 * Created by PhpStorm.
 * User: manel
 * Date: 19/01/17
 * Time: 20:38
 */
class EnrollmentControllerTestMock
{
    protected $apiResult = '[{
        "name": "Hic esse sit hic ea.",
        "done": true,
        "priority": 2,
        "created_at": "2016-11-22",
        "updated_at": "2016-11-22"
        },
        {
        "name": "Odio omnis minus blanditiis eos.",
        "done": true,
        "priority": 9,
        "created_at": "2016-11-22",
        "updated_at": "2016-11-22"
        },
        {
        "name": "Delectus in ea nihil molestiae officiis enim quia.",
        "done": false,
        "priority": 6,
        "created_at": "2016-11-22",
        "updated_at": "2016-11-22"
        }]';

    public function __construct()
    {
        //burlar
        $this->mock = Mockery::mock('GuzzleHttp\Client');
    }

    public function tearDown()
    {
        Mockery::close();
    }
}