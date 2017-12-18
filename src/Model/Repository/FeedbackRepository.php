<?php

namespace Model\Repository;

use Library\EntityRepository;

/**
 * Class FeedbackRepository
 * @package Model\Repository
 */
class FeedbackRepository extends EntityRepository
{
    /**
     * @param $feedback
     */
    public function save($feedback)
    {
        $sql = "INSERT INTO feedback(username, email, message, ip_address)
                VALUES (:username, :email, :message, :ip_address)";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(
            [
                'username' => $feedback->getUsername(),
                'email' =>  $feedback->getEmail(),
                'message' =>  $feedback->getMessage(),
                'ip_address' =>  $feedback->getIpAddress(),
            ]
        );
    }
}