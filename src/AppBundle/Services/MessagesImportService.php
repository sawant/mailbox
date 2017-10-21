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

class MessagesImportService
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    public function __construct(Serializer $serializer, MessageRepository $messageRepository)
    {
        $this->serializer        = $serializer;
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param $filename
     * @return Messages|bool|string
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function import($filename)
    {
        $messages = file_get_contents($filename);

        /** @var Messages $messages */
        $messages = $this->serializer->deserialize($messages, Messages::class, 'json');

        /** @var Message $message */
        foreach ($messages->getMessages() as $message) {
            $this->messageRepository->save($message);
        }

        // Flush outside the loop so that it flushes persisted data only once, instead of on each save
        $this->messageRepository->flush();

        return $messages->getTotal();
    }
}