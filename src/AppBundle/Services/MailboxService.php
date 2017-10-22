<?php
/**
 * User: Sawant
 * Date: 21/10/2017
 */

namespace AppBundle\Services;

use AppBundle\Entity\Message;
use AppBundle\Entity\Messages;
use AppBundle\Repository\MessageRepository;
use JMS\Serializer\Serializer;

/**
 * Class MailboxService
 * @package AppBundle\Services
 */
class MailboxService
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * MailboxService constructor
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function listAll($limit = 10, $offset = 0)
    {
        return $this->messageRepository->findBy([], [], $limit, $offset);
    }
}