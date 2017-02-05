<?php

namespace App\Model;

/**
 * Index Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class Index {

    /**
     * Get Songs: Returns an array of songs.
     * @access public
     * @return array
     * @since 1.0
     */
    public static function getSongs() {
        return [
            ["artist" => "Ed Sheeran", "title" => "Shape Of You"],
            ["artist" => "Ed Sheeran", "title" => "Castle On The Hill"],
            ["artist" => "Jax Jones feat. RAYE", "title" => "You Don't Know Me"],
            ["artist" => "Little Mix", "title" => "Touch"],
            ["artist" => "The Chainsmokers", "title" => "Paris"],
            ["artist" => "Starley & Ryan Riback", "title" => "Call on Me"],
            ["artist" => "Rag'n'Bone Man", "title" => "Human"],
            ["artist" => "Clean Bandit & Anne-Marie feat. Sean Paul", "title" => "Rockabye"],
            ["artist" => "JP Cooper", "title" => "September Song"],
            ["artist" => "Sean Paul feat. Dua Lipa", "title" => "No Lie"]
        ];
    }

}
