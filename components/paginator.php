<?php

namespace app\components;

class Paginator
{
    public $total;
    public $limit;
    public $page;

    public function __construct($total, $limit, $page)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->page = $page;
    }

    public function getLinks($prefix = '', $suffix = '')
    {
        $linksCount = ceil($this->total / $this->limit);

        $navigation = "<ul class='pagination'>";

        if ($this->page > 1) {
            $navigation .= "<li><a href='{$prefix}1{$suffix}'>First</a></li>";
        }

        for ($i = 1; $i <= $linksCount; $i++) {
            $navigation .= ($this->page == $i)
                ? "<li class='active'><span>{$i}</span></li>"
                : "<li><a href='{$prefix}{$i}{$suffix}'>{$i}</a></li>";
        }

        if ($this->page < $linksCount) {
            $navigation .= "<li><a href='{$prefix}{$linksCount}{$suffix}'>Last</a></li>";
        }

        $navigation .= '</ul>';

        return $navigation;
    }
}
