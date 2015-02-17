<?php

use App\User;

class ErrorCodeTest extends TestCase {

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

    /**
     * Test that if we go to a page that we shouldn't, we get a 403 response.
     *
     * @return void
     */
    public function test403()
    {
        $user = new User(array('rank'      => 3));

        $this->be($user);

        $response = $this->call('GET', '/users');

        $this->assertEquals(403, $response->getStatusCode());
    }

}
