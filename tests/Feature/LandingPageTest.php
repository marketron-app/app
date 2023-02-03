<?php

it('has landingpage page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
