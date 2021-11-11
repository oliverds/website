<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\MarkdownConverterInterface;
use Torchlight\Commonmark\V2\TorchlightExtension;

class Markdown extends Component
{
    protected $flavor;

    protected $htmlInput;

    protected $allowUnsafeLinks;

    protected $options;

    protected $anchors;

    protected $url;

    public function __construct(
        string $flavor = 'default',
        string $htmlInput = 'allow',
        bool $allowUnsafeLinks = true,
        array $options = [],
        bool $anchors = false
    ) {
        $this->flavor = $flavor;
        $this->htmlInput = $htmlInput;
        $this->allowUnsafeLinks = $allowUnsafeLinks;
        $this->options = $options;
        $this->anchors = $anchors;
    }

    public function render(): View
    {
        return view('components.markdown');
    }

    public function toHtml(string $markdown): string
    {
        if ($this->anchors) {
            $markdown = $this->generateAnchors($markdown);
        }

        return (string) $this->converter()->convertToHtml($markdown);
    }

    protected function converter(): MarkdownConverterInterface
    {
        $options = array_merge($this->options, [
            'html_input' => $this->htmlInput,
            'allow_unsafe_links' => $this->allowUnsafeLinks,
        ]);

        $environment = new Environment($options);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TorchlightExtension);

        if ($this->flavor === 'github') {
            $environment->addExtension(new GithubFlavoredMarkdownExtension());
        }

        return new MarkdownConverter($environment);
    }

    protected function generateAnchors(string $markdown): string
    {
        preg_match_all('(```[a-z]*\n[\s\S]*?\n```)', $markdown, $matches);

        collect($matches[0] ?? [])->each(function (string $match, int $index) use (&$markdown) {
            $markdown = str_replace($match, "<!--code-block-$index-->", $markdown);
        });

        $markdown = collect(explode(PHP_EOL, $markdown))
            ->map(function (string $line) {
                // For levels 2 to 6.
                $anchors = [
                    '## ',
                    '### ',
                    '#### ',
                    '##### ',
                    '###### ',
                ];

                if (! Str::startsWith($line, $anchors)) {
                    return $line;
                }

                $title = trim(Str::after($line, '# '));
                $anchor = '<a class="anchor" name="'.Str::slug($title).'"></a>';

                return $anchor.PHP_EOL.$line;
            })
            ->implode(PHP_EOL);

        collect($matches[0] ?? [])->each(function (string $match, int $index) use (&$markdown) {
            $markdown = str_replace("<!--code-block-$index-->", $match, $markdown);
        });

        return $markdown;
    }
}
