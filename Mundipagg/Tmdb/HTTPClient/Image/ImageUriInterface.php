<?php

/**
 * Interface for classes that returns a string image uri
 *
 * @package Mundipagg\Tmdb\HTTPClient\Image
 * @author Antonio Gutierrez <gutierrez.computacao@gmail.com>
 * @version 1.0.0
 */
namespace Mundipagg\Tmdb\HTTPClient\Image;


interface ImageUriInterface
{
    const IMAGE_PATH = "tmp";
    const IMAGE_URI = 'https://image.tmdb.org/t/p/w300';

    /**
     * @param  string $imageUri
     * @return Mundipagg\Tmdb\HTTPClient\Image\ImageUriInterface
     */
    public function setImageUri(string $imageUri): ImageUriInterface;

    /**
     * @return string
     */
    public function getImageUri(): string;
}