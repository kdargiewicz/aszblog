<?php

namespace App\Web\Helpers;

use Illuminate\Support\Collection;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class BlogHelper
{
    public function markTallArticles(Collection $articles): Collection
    {
        $count = $articles->count();
        $tallIndexes = $this->getTallIndexesByCount($count);

        return $articles->map(function ($item, $index) use ($tallIndexes) {
            $item->tall = in_array($index, $tallIndexes);
            return $item;
        });
    }

    private function getTallIndexesByCount(int $count): array
    {
        return config("blog.articles_grid.{$count}", []);
    }

    public function transformImagesToGroupedGallery(string $html): string
    {
        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $body = $doc->getElementsByTagName('body')->item(0);
        $xpath = new DOMXPath($doc);

        $pWithImg = $xpath->query('//p[count(img)=1 and count(*)=1]');
        foreach ($pWithImg as $p) {
            $img = $p->firstChild;

            $figure = $doc->createElement('figure');
            $figure->setAttribute('class', 'image gallery-item-blogy');

            $imgClone = $img->cloneNode(true);
            $imgClone->removeAttribute('width');
            $imgClone->removeAttribute('height');
            $imgClone->removeAttribute('style');
            $imgClone->setAttribute('class', 'w-full h-auto rounded shadow');
            $figure->appendChild($imgClone);

            $figcaption = $doc->createElement('figcaption', '');
            $figure->appendChild($figcaption);

            $body->replaceChild($figure, $p);
        }

        $figures = $xpath->query('//figure[img]');
        foreach ($figures as $figure) {
            $existingClass = $figure->getAttribute('class');
            if (strpos($existingClass, 'gallery-item-blogy') === false) {
                $figure->setAttribute('class', trim($existingClass . ' gallery-item-blogy'));
            }

            if ($figure->getElementsByTagName('figcaption')->length === 0) {
                $figcaption = $doc->createElement('figcaption', '');
                $figure->appendChild($figcaption);
            }

            $img = $figure->getElementsByTagName('img')->item(0);
            if ($img) {
                $img->removeAttribute('width');
                $img->removeAttribute('height');
                $img->removeAttribute('style');
                $img->setAttribute('class', 'w-full h-auto rounded shadow');
            }
        }

        $children = iterator_to_array($body->childNodes);
        $currentGroup = [];

        foreach ($children as $node) {
            if ($this->isIgnorableWhitespaceNode($node)) {
                // traktuj jako przezroczysty
                continue;
            }

            if (
                $node->nodeType === XML_ELEMENT_NODE &&
                $node->nodeName === 'p' &&
                $this->isWhitespaceParagraph($node)
            ) {
                // puste <p> (&nbsp;, spacje) — przezroczyste
                continue;
            }

            if (
                $node->nodeType === XML_ELEMENT_NODE &&
                $node->nodeName === 'figure' &&
                strpos($node->getAttribute('class'), 'gallery-item-blogy') !== false
            ) {
                $currentGroup[] = $node;
            } else {
                if (count($currentGroup) > 1) {
                    $this->wrapGalleryGroup($doc, $body, $currentGroup);
                }
                $currentGroup = [];
            }
        }

        if (count($currentGroup) > 1) {
            $this->wrapGalleryGroup($doc, $body, $currentGroup);
        }

        // Oznacz samotne figure.gallery-item (niebędące w .gallery wrapperze)
        $galleryItems = $xpath->query('//figure[contains(@class, "gallery-item-blogy")]');

        foreach ($galleryItems as $figure) {
            $parent = $figure->parentNode;

            if (
                $parent->nodeType === XML_ELEMENT_NODE &&
                $parent->nodeName === 'div' &&
                strpos($parent->getAttribute('class'), 'gallery') !== false
            ) {
                // już wewnątrz wrappera .gallery – pomiń
                continue;
            }

            // Dodaj klasę standalone-image
            $class = $figure->getAttribute('class');
            if (strpos($class, 'standalone-image') === false) {
                $figure->setAttribute('class', trim($class . ' standalone-image'));
            }
        }

        $html = $doc->saveHTML($body);
        $html = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $html);
        return trim($html);
    }

    private function wrapGalleryGroup(DOMDocument $doc, DOMElement $body, array $figures)
    {
        $wrapper = $doc->createElement('div');
        $wrapper->setAttribute('class', 'gallery flex flex-wrap justify-center gap-4 my-6');

        $first = $figures[0];
        $body->insertBefore($wrapper, $first);

        foreach ($figures as $figure) {
            $wrapper->appendChild($figure);
        }
    }

    private function isIgnorableWhitespaceNode(DOMNode $node): bool
    {
        return $node->nodeType === XML_TEXT_NODE && trim($node->nodeValue) === '';
    }

    private function isWhitespaceParagraph(DOMElement $node): bool
    {
        if ($node->nodeName !== 'p') {
            return false;
        }

        foreach ($node->childNodes as $child) {
            if ($child->nodeType === XML_TEXT_NODE) {
                $text = str_replace("\xC2\xA0", '', $child->nodeValue); // usuń &nbsp;
                if (trim($text) !== '') {
                    return false;
                }
            } elseif ($child->nodeType === XML_ELEMENT_NODE) {
                // sprawdź, czy to inline tag z samymi spacjami w środku
                $inlineTags = ['strong', 'b', 'em', 'i', 'span', 'u', 'small'];

                if (in_array($child->nodeName, $inlineTags)) {
                    $innerText = $child->textContent ?? '';
                    $innerText = str_replace("\xC2\xA0", '', $innerText);
                    if (trim($innerText) !== '') {
                        return false;
                    }
                } elseif ($child->nodeName !== 'br') {
                    return false;
                }
            }
        }

        return true;
    }
}
