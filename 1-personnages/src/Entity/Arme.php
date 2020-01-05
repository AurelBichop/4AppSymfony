<?php

namespace App\Entity;

class Arme
{

    public $nom;
    public $description;
    public $degats;

    public static $armes = [];


    public function __construct(string $nom, string $description, int $degats)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->degats = $degats;
        self::$armes[] = $this;
    }

    /**
     * Creer les armes
     *
     * @return void
     */
    public static function creerArmes()
    {
        new Arme("épée", "Une belle épée, elle coupe bien", 10);
        new Arme("hache", "Une Hache de barbar", 15);
        new Arme("arc", "ça pique le cul", 7);
    }

    /**
     * Recupere l'arme recherché par son nom
     *
     * @param string $nom
     * @return void
     */
    public static function recupArme(string $nom)
    {
        foreach (self::$armes as $arme) {
            if (strtolower(str_replace("é", "e", $arme->nom)) === $nom) {
                return $arme;
            }
        }
    }
}
