<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 02/06/19
 * Time: 15:21
 */

namespace Mundipagg\Tmdb\WebService;

interface TmdbWebServiceInterfaceOld
{
    /**
     * Add custom parameters to send with API request
     *
     * @param array $data
     * @return \Mundipagg\Tmdb\WebService\TmdbWebService $this
     */
    public function addData(array $data): TmdbWebServiceInterface;

    /**
     * Instantiates request if necessary and sends off with collected data
     *
     * @return mixed
     */
    public function sendRequest();
}