<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 7/14/16
 * Time: 8:58 PM
 */

use Project1\Domain\StringLiteral;
use Project1\Infrastructure\InMemoryUserRepository;

describe('Project1\Infrastructure\InMemoryUserRepository', function () {
    describe('->__constructor()', function() {
        it('should return a InMemoryUserRepository object', function () {
            $repo = new InMemoryUserRepository();
            expect($repo)->to->be->instanceof(
                'Project1\Infrastructure\InMemoryUserRepository'
            );
        });
    });
    // TODO: need to write add function for this test to work
    describe('->findByEmail("bill@gmail.com")', function() {
        it('should return a valid user object', function () {
            $repo = new InMemoryUserRepository();
            $users = $repo->findByEmail(new StringLiteral('bill@gmail.com'));
            expect($users)->to->be->an('array');
            expect(1 === count($users))->to->be->true();
        });
    });
});

