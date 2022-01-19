<?php

declare(strict_types=1);

class User
{
    /**
     * @var const STATUS_ACTIVE Statut active  */
    protected const STATUS_ACTIVE = 'active';

    /**
     * @var const STATUS_INACTIVE Statut inactive */
    protected const STATUS_INACTIVE = 'inactive';


    /**
     * Constructeur
     * @param string $username Nom de l'utilisateur
     * @param string $status Statut de l'utilisateur
     * 
     * @example user(new User('yaya', STATUS_INACTIVE))
     */
    public function __construct(protected string $username, protected string $status = self::STATUS_ACTIVE)
    {
    }

    /**
     * Fonction qui stoke le statut de l'utilisateur
     * 
     * @param string $statut Le statut de l'utilisateur
     * 
     * @author cool yaya
     * @version 1.0
     */
    protected function setStatus(string $status): void
    {
        assert(
            in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE]), sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE]))
        );
        $this->status = $status;
    }

    /**
     * Fonction qui recupère le statut de l'utilisateur
     * 
     * @return statut
     * @version 1.0
     * 
     */
    protected function getStatus(): string
    {
        return $this->status;
    }
}
 

class Admin extends User
{

    public const STATUS_LOCKED = 'locked';

    // la méthode est entièrement ré-écrite ici :) seule la signature reste inchangée
    public function setStatus(string $status): void
    {
        assert(
            in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE,self::STATUS_LOCKED]), sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_LOCKED]))
        );
        $this->status = $status;
    }

    // la méthode utilise celle de la classe parente, et ajoute un comportement :)
    public function getStatus(): string
    {
        return strtoupper(parent::getStatus());
    }
   
}

$admin = new Admin('Lily');
$admin->setStatus(Admin::STATUS_LOCKED);
$admin->getStatus();

