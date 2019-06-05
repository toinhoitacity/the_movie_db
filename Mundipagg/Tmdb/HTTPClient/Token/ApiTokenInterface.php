<?php

/**
 * Basic interface that returns a token
 *
 * @package Mundipagg\Tmdb\HTTPClient\Token
 * @author Antonio Gutierrez <gutierrez.computacao@gmail.com>
 * @version 1.0.0
 */
namespace Mundipagg\Tmdb\HTTPClient\Token;

interface ApiTokenInterface
{
    const API_TOKEN = "6e60d556d8ca594a46e2b7e0639ca777"; //Developer's API Token.

    /**
     * @param  string $apiToken
     * @return Mundipagg\Tmdb\HTTPClient\Token\ApiTokenInterface
     */
    public function setToken(string $apiToken): ApiTokenInterface;

    /**
     * @return string
     */
    public function getToken(): string;

}