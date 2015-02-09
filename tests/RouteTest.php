<?php

class RouteTest extends TestCase {

	/**
	 * Test that if we go to a page that does not exist, we get a 404 response.
	 *
	 * @return void
	 */
	public function test404()
	{
		$response = $this->call('GET', '/abcde');

		$this->assertEquals(404, $response->getStatusCode());
	}

}
