<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2016/12/20
 * Time: 20:25
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text)
    {
        $html = $this->parser->makeHtml($text);
        return $html;
    }

}