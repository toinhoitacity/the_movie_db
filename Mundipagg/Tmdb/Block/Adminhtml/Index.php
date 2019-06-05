<?php

/**
 * Index Block Class
 *
 * @package Mundipagg\Tmdb\Block\Adminhtml
 * @author Antonio Gutierrez <gutierrez.computacao@gmail.com>
 * @version 1.0.0
 */
namespace Mundipagg\Tmdb\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use \Magento\Backend\Block\Template\Context;
use Mundipagg\Tmdb\WebService\TmdbWebServiceInterface;
use Mundipagg\Tmdb\Api\TmdbRepositoryInterface;

class Index extends Template
{

    /**
     * @var \Mundipagg\Tmdb\WebService\TmdbWebServiceInterface $tmdbWebService
     */
    private $tmdbWebService;

    /**
     * @var \Mundipagg\Tmdb\Api\TmdbRepositoryInterface $tmdbRepository
     */
    private $tmdbRepository;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param TmdbWebServiceInterface $tmdbWebService
     * @param TmdbRepositoryInterface $tmdbRepository
     */
    public function __construct(
        Context $context,
        TmdbWebServiceInterface $tmdbWebService,
        TmdbRepositoryInterface $tmdbRepository
    )
    {
        $this->tmdbWebService = $tmdbWebService;
        $this->tmdbRepository = $tmdbRepository;
        parent::__construct($context);
    }

    public function getMovie()
    {
        $this->tmdbWebService->setMethodUrl("discover/movie");

        $this->tmdbWebService->addParams([
            "sort_by"       =>  "popularity.desc",
            "include_adult" =>  "false",
            "include_video" =>  "false",
            "page"          =>  $this->getPage()
        ]);

        return $this->tmdbWebService->sendRequest();
    }
}