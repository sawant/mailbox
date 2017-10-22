<?php

namespace AppBundle\Controller;

use AppBundle\Services\MailboxService;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class MailboxController
 *
 * @package AppBundle\Controller
 */
class MailboxController extends FOSRestController
{
    /**
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($page)
    {
        /** @var MailboxService $mailboxService */
        $mailboxService = $this->get('mailbox');

        $view = $this->view($mailboxService->listAll(10, $this->getOffset($page)));

        return $this->handleView($view);
    }

    /**
     * @param $page
     *
     * @return int
     */
    protected function getOffset($page)
    {
        return (intval($page) - 1) * 10;
    }
}
