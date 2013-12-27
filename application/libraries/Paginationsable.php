<?php
    class PaginationsAble
    {
        private $baseURL;
        private $totalRows;
        private $rowsPerPage;
        private $accessedPage;
        private $totalNumberPages;
        private $htmlLinks;
        private $limit;
        private $offSet;
        
        function __construct($baseURL = null, $totalRows = null, $rowsPerPage = null, $accessedPage = null)
        {
            $this->baseURL = $baseURL;
            $this->totalRows = $totalRows;
            $this->rowsPerPage = $rowsPerPage;
            $this->accessedPage = $accessedPage;
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
            if((empty($this->rowsPerPage)) or ($this->rowsPerPage == null) or ($this->rowsPerPage == ''))
            {
                return 10;
            }
            else
            {
                return $this->rowsPerPage;
            }
        }

        public function setRowsPerPage($rowsPerPage) {
            $this->rowsPerPage = $rowsPerPage;
        }

        public function getAccessedPage() {
            return $this->accessedPage;
        }

        public function setAccessedPage($accessedPage) {
            $this->accessedPage = $accessedPage;
        }
        
        public function getHtmlLinks() {
            return $this->htmlLinks;
        }
        
        public function getTotalNumberPages() {
            return $this->totalNumberPages;
        }

        public function setTotalNumberPages($totalNumberPages) {
            $this->totalNumberPages = $totalNumberPages;
        }
        
        public function getLimit() {
            return $this->limit;
        }

        public function setLimit($limit) {
            $this->limit = $limit;
        }

        public function getOffSet() {
            return $this->offSet;
        }

        public function setOffSet($offSet) {
            $this->offSet = $offSet;
        }
        
        public function doCalculations()
        {
            if((empty($this->totalRows)) or ($this->totalRows == null) or ($this->totalRows == ''))
            {
                return false;
            }
            else
            {
                $this->totalNumberPages = ceil($this->totalRows / $this->getRowsPerPage());
                $this->limit = $this->getRowsPerPage();
                $this->offSet = ($this->accessedPage - 1) * $this->getRowsPerPage();
                return true;
            }
        }
        
        public function createLinks()
        {
            $this->htmlLinks = null;
            $this->htmlLinks = '';
            if($this->doCalculations() == false)
            {
                $this->htmlLinks = 'Os links das paginações não puderam ser gerados.';
                return false;
            }
            else
            {
                $this->htmlLinks .= '<ul class="pagination">';
                if($this->accessedPage == 1)
                {
                    $this->htmlLinks .= '<li class="disabled"><a href="' . site_url($this->baseURL . '/1') . '">&laquo;</a></li>';
                }
                else
                {
                    $this->htmlLinks .= '<li><a href="' . site_url($this->baseURL . '/1') . '">&laquo;</a></li>';
                }
                if($this->accessedPage == 1)
                {
                    $this->htmlLinks .= '<li class="disabled"><a href="' . site_url($this->baseURL . '/1') . '"><</a></li>';
                }
                else
                {
                    $this->htmlLinks .= '<li><a href="' . site_url($this->baseURL . '/' . ($this->accessedPage - 1)) . '"><</a></li>';
                }
                for($i = 1 ; $i <= $this->totalNumberPages ; $i++)
                {
                    if($i == $this->accessedPage)
                    {
                        $this->htmlLinks .= '<li class="active"><a href="' . site_url($this->baseURL . '/' . $i) . '">' . $i . '</a></li>';
                    }
                    else
                    {
                        $this->htmlLinks .= '<li><a href="' . site_url($this->baseURL . '/' . $i) . '">' . $i . '</a></li>';
                    }
                }
                if($this->totalNumberPages == $this->accessedPage)
                {
                    $this->htmlLinks .= '<li class="disabled"><a href="' . site_url($this->baseURL . '/' . $this->accessedPage) . '">></a></li>';
                }
                else
                {
                    $this->htmlLinks .= '<li><a href="' . site_url($this->baseURL . '/' . ($this->accessedPage + 1)) . '">></a></li>';
                }
                if($this->totalNumberPages == $this->accessedPage)
                {
                    $this->htmlLinks .= '<li class="disabled"><a href="' . site_url($this->baseURL . '/' . $this->totalNumberPages) . '">&raquo;</a></li>';
                }
                else
                {
                    $this->htmlLinks .= '<li><a href="' . site_url($this->baseURL . '/' . $this->totalNumberPages) . '">&raquo;</a></li>';
                }
                $this->htmlLinks .= '</ul>';
                return true;
            }
        }
    }
?>