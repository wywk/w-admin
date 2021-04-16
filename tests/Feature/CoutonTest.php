<?php

namespace Tests\Feature;

use Nyg\Tool\Market;
use Tests\TestCase;

class CoutonTest extends TestCase
{

    public function test1()
    {
        $app = 1;
        $business = config('my.business');
        $market = new Market($app, $business[$app]['key'], Market::ENV_DEVELOP);
        $market->setUrl('http://market.test');
        $result = $market->app('test', ['name' => '43242']);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(0, $result['code'], $result['msg']);
    }

    public function testDraw()
    {
        $app = 1;
        $business = config('my.business');
        $market = new Market($app, $business[$app]['key'], Market::ENV_DEVELOP);
        $market->setUrl('http://market.test');
        $data['custom_id'] = 'MDAyNjgxNFgO0O0O';
        $data['id'] = 100;
        $data['is_lock'] = 0;
        $result = $market->app('coupon/draw', $data);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(0, $result['code'], $result['msg']);
    }
}
