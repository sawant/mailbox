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
     * @param array $filter
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function listAll($filter = [], $limit = 10, $offset = 0)
    {
        $criteria = [];

        if (!empty($filter)) {
            $criteria = ["$filter" => true];
        }

        return $this->messageRepository->findBy($criteria, null, $limit, $offset);
    }

    /**
     * @param $messageId
     *
     * @return null|object
     */
    public function get($messageId)
    {
        return $this->messageRepository->find($messageId);
    }
}