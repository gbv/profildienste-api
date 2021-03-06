<?php

namespace Profildienst\Search;

class KeywordSearch extends SearchQuery {

    private $mode;
    private $searchterm;


    public function __construct($type = 'keyword') {
        parent::__construct($type);
    }

    public function getMode() {
        return $this->mode;
    }

    public function setMode($mode) {
        $this->mode = $mode;
    }

    public function getSearchterm() {
        return $this->searchterm;
    }

    public function setSearchterm($searchterm) {
        $this->searchterm = $searchterm;
    }

    /**
     * @return QueryBuilder Query ready to be used for the database
     */
    public function getDatabaseQuery() {

        $searchterm = $this->handleSearchterm($this->searchterm, $this->mode);

        $this->dbquery
            ->searchTitleField($searchterm)
            ->searchPersonField($searchterm)
            ->searchVerlagField($searchterm)
            ->searchDNBNrField($searchterm)
            ->searchISBNField($searchterm)
            ->searchDNBSachgruppeField($searchterm)
            ->searchErscheinungsjahrField($searchterm)
            ->searchWVNField($searchterm)
            ->searchMAKField($searchterm)
            ->joinWithOr();

        return $this->dbquery;
    }

    /**
     * @return array Returns a representation of the search critera as a plain array.
     */
    public function getSearchAsArray() {
        return array(
            'mode' => $this->mode,
            'field' => $this->searchterm
        );
    }
}