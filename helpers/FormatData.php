<?php

namespace app\helpers;

class FormatData
{
    public function buildTreeHtml($data)
    {
        $tree = $this->convertDataToArray($data);
        if ($tree === null) {
            throw new \InvalidArgumentException('Invalid data format provided.');
        }

        return $this->renderTree($tree);
    }

    private function convertDataToArray($data)
    {
        if (is_array($data)) {
            return $data;
        } elseif (is_object($data)) {
            // Convert object to array
            return json_decode(json_encode($data), true);
        }

        return null;
    }

    private function renderTree($tree)
    {
        $html = '';
        foreach ($tree as $node) {
            $html .= '<li>' . $node['categories_id'];
            if (!empty($node['children'])) {
                $html .= '<span class="arrow">&#9658;</span>';
                $html .= '<ul>';
                $html .= $this->renderTree($node['children']);
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }
}
