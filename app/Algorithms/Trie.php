<?php

namespace App\Algorithms;

class Trie
{
    private $root = [];

    public function insert($word, $id)
    {
        $node = &$this->root;

        foreach (str_split(strtolower($word)) as $char) {
            $node[$char] ??= [];
            $node = &$node[$char];
        }

        $node['#'] = [
            'id' => $id,
            'title' => $word
        ];
    }


    public function search($prefix)
    {
        $node = &$this->root;

        foreach (str_split(strtolower($prefix)) as $char) {

            if (!isset($node[$char])) {
                return [];
            }

            $node = &$node[$char];
        }

        return $this->collect($node);
    }


    private function collect($node)
    {
        $result = [];

        foreach ($node as $key => $value) {

            if ($key === '#') {
                $result[] = $value;
            } else {
                $result = array_merge(
                    $result,
                    $this->collect($value)
                );
            }
        }

        return $result;
    }
}