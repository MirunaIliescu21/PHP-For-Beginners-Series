<?php

it('validates a string', function() {
    expect(\Core\Validator::string('foobar'))->toBeTrue();
    expect(\Core\Validator::string(false))->toBeFalse();
    expect(\Core\Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum length', function() {
    expect(\Core\Validator::string('foobar', 20))->toBeFalse();
});


it('validates a email', function() {
    expect(\Core\Validator::email('foobar'))->toBeFalse();
    expect(\Core\Validator::email('test@example.com'))->toBeTrue();
});

it('validates that a number is greater than a given amount', function() {
    expect(\Core\Validator::greaterThan(20, 10))->toBeTrue();
    expect(\Core\Validator::greaterThan(5, 10))->toBeFalse();

});