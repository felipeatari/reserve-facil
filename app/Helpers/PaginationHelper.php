<?php

namespace App\Helpers;

class PaginationHelper
{
    /**
     * Pagina atual
     *
     * @var integer
     */
    public int $currentPage = 0;

    /**
     * Página atual selecionada
     *
     * @var integer
     */
    public int $currentPageChecked = 0;

    /**
     * Quantos links aparecem por página
     *
     * @example Page 1, Page 2, Page 3...
     *
     * @var integer
     */
    public int $numberOfPages;

    /**
     * Última página
     *
     * @var integer
     */
    public int $lastPage = 0;

    /**
     * Quantas páginas foram retornadas
     *
     * @var integer
     */
    public int $countPages = 0;

    /**
     * Totas as páginas disponíveis
     *
     * @var array
     */
    public array $pages = [];

    /**
     * Se existe próxima página
     *
     * @var boolean
     */
    public bool $nextPage = false;

    /**
     * Se existe página anterior
     *
     * @var boolean
     */
    public bool $previousPage = false;

    /**
     * URL da próxima página
     *
     * @var string|null
     */
    public ?string $nextPageUrl = '';

    /**
     * URL da próxima página
     *
     * @var string|null
     */
    public ?string $previousPageUrl = '';

    /**
     * Cria a paginação
     *
     * @param object|array $entity Model com a paginação
     * @param integer $numberOfPages Quandidade de links por página
     */
    public function __construct(object|array $entity, int $numberOfPages = 5)
    {
        $this->currentPage = $entity->currentPage();
        $this->currentPageChecked = $entity->currentPage();
        $this->countPages = $entity->count();
        $this->lastPage = $entity->lastPage();
        $this->nextPageUrl = $entity->nextPageUrl();
        $this->previousPageUrl = $entity->previousPageUrl();
        $this->numberOfPages = $numberOfPages;

        // Se houver registro
        if ($this->countPages) {
            // Se o número de links por página for menor que a quantidade de páginas
            if ($this->numberOfPages < $this->lastPage) {
                for ($i = 1; $i <= $this->numberOfPages; $i++) {
                    $this->pages[] = ($this->currentPage + $i) - 1;
                }
            } else {
                for ($i = 1; $i <= $this->numberOfPages; $i++) {
                    $this->pages[] = $i;
                }
            }

            // Garante a quantidade de links preferidos
            $this->pages = array_filter($this->pages, fn($page) => $page <= $this->lastPage);

            // Configura os links da página anterior e da próxima página
            if ($this->lastPage > $this->numberOfPages) {
                $this->nextPage = $this->currentPage > 1;
                $this->previousPage = $entity->currentPage() < $this->lastPage;
            }
        }
    }
}
