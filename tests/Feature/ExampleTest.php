<?php

it('has homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
