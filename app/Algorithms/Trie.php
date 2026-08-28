<?php

namespace App\Algorithms;

class Trie
{
    private $root = [];

    public function insert($word, $id)
    {
        $word = strtolower($word);
        $length = strlen($word);

        for ($i = 0; $i < $length; $i++) {
            $node = &$this->root;

            for ($j = $i; $j < $length; $j++) {
                $char = $word[$j];

                $node[$char] ??= [];
                $node = &$node[$char];
            }

            $node['#'][] = [
                'id' => $id,
                'title' => $word
            ];
        }
    }

    public function search($query)
    {
        $node = &$this->root;

        foreach (str_split(strtolower($query)) as $char) {
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
                $result = array_merge($result, $value);
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
