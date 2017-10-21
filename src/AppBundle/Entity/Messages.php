<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Messages
 *
 * A collection class for 'Message'
 */
class Messages
{
    /**
     * @var Message[]
     *
     * @Serializer\Type("array<AppBundle\Entity\Message>")
     */
    private $messages;

    /**
     * Set messages
     *
     * @param array $messages
     *
     * @return Messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function getTotal()
    {
        return sizeof($this->messages);
    }
}

