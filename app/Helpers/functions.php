<?php
/**
 * @param $string
 * @return string
 */
function html($string)
{
    return htmlspecialchars($string, ENT_QUOTES);
}

/**
 * @param string $text
 * @param int    $sub
 * @param string $end
 * @return string
 */
function subText(string $text, int $sub, string $end = ' ...')
{
    if (mb_strlen($text) > $sub) {
        $text = mb_substr($text, 0, $sub);
        $text = mb_substr($text, 0, mb_strrpos($text, ' '));
        $text .= $end;
    }

    return $text;
}
