<?php
    class PaginationAble
    {
        private $baseURL;
        private $totalRows;
        private $RowsPerPage;
        private $pageAccessed;
        private $htmlLinks;
        
        function __construct($baseURL = null, $totalRows = null, $RowsPerPage = null, $pageAccessed = null)
        {
            $this->baseURL = $baseURL;
            $this->totalRows = $totalRows;
            $this->RowsPerPage = $RowsPerPage;
            $this->pageAccessed = $pageAccessed;
        }
        
        public function getBaseURL() {
            return $this->baseURL;
        }

        public function setBaseURL($baseURL) {
            $this->baseURL = $baseURL;
        }

        public function getTotalRows() {
            return $this->totalRows;
        }

        public function setTotalRows($totalRows) {
            $this->totalRows = $totalRows;
        }

        public function getRowsPerPage() {
            return $this->RowsPerPage;
        }

        public function setRowsPerPage($RowsPerPage) {
            $this->RowsPerPage = $RowsPerPage;
        }

        public function getPageAccessed() {
            return $this->pageAccessed;
        }

        public function setPageAccessed($pageAccessed) {
            $this->pageAccessed = $pageAccessed;
        }
        
        public function getHtmlLinks() {
            return $this->htmlLinks;
        }
        
        public function createLinks()
        {
            $this->htmlLinks = null;
        }
    }
?>