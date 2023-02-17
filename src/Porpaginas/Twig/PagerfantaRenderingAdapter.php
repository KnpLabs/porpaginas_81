<?php
/**
 * Porpaginas
 *
 * LICENSE
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Porpaginas\Twig;

use Pagerfanta\Pagerfanta;
use Porpaginas\Page;
use Porpaginas\Pagerfanta\PorpaginasAdapter;
use Twig\Environment;

class PagerfantaRenderingAdapter implements RenderingAdapter
{
    /**
     * @var string
     */
    private $viewName;

    /**
     * @var array
     */
    private $options;

    public function __construct($viewName = null, $options = array())
    {
        $this->viewName = $viewName;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function renderPagination(Page $page, Environment $environment)
    {
        $pagerfanta = new Pagerfanta(new PorpaginasAdapter($page));
        $pagerfanta->setCurrentPage($page->getCurrentPage());
        $pagerfanta->setMaxPerPage($page->getCurrentLimit());

        return $environment->getExtension('pagerfanta')->renderPagerfanta(
            $pagerfanta, $this->viewName, $this->options
        );
    }
}
