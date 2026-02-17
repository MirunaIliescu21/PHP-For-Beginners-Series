<?php

use Core\Container;

test('it can resolve something out of the container', function () {
    // Arrange
    $container = new Container();
    $container->bind('foo', function () {
        return 'bar';
    });

    // Act
    $result = $container->resolve('foo');

    // Assert/expect
    expect($result)->toBe('bar');

});
